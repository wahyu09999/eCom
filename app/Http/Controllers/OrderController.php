<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function App\Helpers\uploadFile;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::user()->id)->paginate(2);
        return view('lp.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $itemcart = Cart::where('status_cart', 'cart')
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($itemcart) {
            foreach ($itemcart->detail as $item) {
                if ($item->alamat_pengiriman_id != null) {
                    continue;
                } else {
                    return redirect()->route('cart.index')->with('error', 'Alamat pengiriman tidak boleh kosong');
                }
            }
            $order = Order::create([
                'cart_id' => $itemcart->id,
                'user_id' => Auth::user()->id
            ]);
            $itemcart->update(['status_cart' => 'checkout']);
            return redirect()->route('showupload', $order->id)->with('success', 'Order berhasil disimpan');
        }
        return back()->with('error', 'Checkout tidak dapat diproses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->cart->update([
            "status_cart" => "cart"
        ]);
        $order->delete();
        return response()->json(['success' => true], 200);
    }

    public function showUpload($id)
    {
        $data = Order::findOrFail($id);
        return view('lp.upload', compact('data'));
    }

    public function uploadBukti(Request $request)
    {
        if ($request->hasFile('bukti_transfer')) {
            $payload = uploadFile($request->file('bukti_transfer'), 'bukti_transfer');
            $order = Order::findOrFail($request->id);
            $order->update([
                'bukti_transfer' => $payload
            ]);
            $id = $order->cart->detail->pluck('produk_id')->toArray();
            $qty = $order->cart->detail->pluck('qty')->toArray();
            $produk = Produk::whereIn('id', $id)->orderBy('id', 'DESC')->pluck('id')->toArray();
            $stok = Produk::whereIn('id', $id)->orderBy('id', 'DESC')->pluck('stok')->toArray();
            for ($i = 0; $i < count($id); $i++) {
                Produk::where('id', $produk[$i])->update([
                    'stok' => $stok[$i] - $qty[$i]
                ]);
                if ($stok[$i] < 0) {
                    Produk::where('id', $produk[$i])->update([
                        'stok' => $stok[$i] - $qty[$i]
                    ]);
                }
            }
            for ($j = 0; $j < count($stok); $j++) {
                if ($stok[$j] < 0) {
                    Produk::where('id', $produk[$j])->update([
                        'stok' => 0
                    ]);
                }
            }
            return redirect()->route('order.index');
        }
        return redirect()->back()->with('error', 'Upload gagal');
    }
}
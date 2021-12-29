<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengiriman;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $this->validate($request, [
            'id' => 'required',
        ]);
        $user_id = Auth::user()->id;
        $itemproduk = Produk::findOrFail($request->id);

        if ($request->qty > $itemproduk->stok) {
            return response()->json(['success' => false, 'msg' => 'Jumlah qty melebihi stok produk'], 500);
        }

        // cek dulu apakah sudah ada shopping cart untuk user yang sedang login
        $cart = Cart::where('user_id', $user_id)
            ->where('status_cart', 'cart')
            ->first();
        if ($cart) {
            $itemcart = $cart;
        } else {
            $no_invoice = Cart::where('user_id', $user_id)->count();
            //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice
            $inputancart['user_id'] = $user_id;
            $inputancart['no_invoice'] = 'INV' . date("ymd", strtotime(now())) . '-' . str_pad(($no_invoice + 1), '5', '0', STR_PAD_LEFT);
            $inputancart['status_cart'] = 'cart';
            $inputancart['status_pembayaran'] = 'belum';
            $inputancart['status_pengiriman'] = 'belum';
            $itemcart = Cart::create($inputancart);
        }
        // cek dulu apakah sudah ada produk di shopping cart
        $cekdetail = CartDetail::where('cart_id', $itemcart->id)
            ->where('produk_id', $itemproduk->id)
            ->first();
        $qty = $request->qty;
        $harga = $itemproduk->harga; //ambil harga produk
        $subtotal = $qty * $harga;
        if ($cekdetail) {
            // update detail di table cart_detail
            $cekdetail->updatedetail($cekdetail, $qty, $harga);
            // update subtotal dan total di table cart
            $cekdetail->cart->updatetotal($cekdetail->cart, $subtotal);
        } else {
            $inputan = $request->all();
            $inputan['cart_id'] = $itemcart->id;
            $inputan['produk_id'] = $itemproduk->id;
            $inputan['qty'] = $qty;
            $inputan['harga'] = $harga;
            $inputan['subtotal'] = ($harga * $qty);
            $itemdetail = CartDetail::create($inputan);

            $alamatutama = AlamatPengiriman::where([
                'user_id' => Auth::user()->id,
                'status' => 1
            ])->first();
            if ($alamatutama) {
                $itemdetail->update([
                    'alamat_pengiriman_id' => $alamatutama->id
                ]);
            }
            // update subtotal dan total di table cart
            $itemdetail->cart->updatetotal($itemdetail->cart, $subtotal);
        }
        return response()->json(['success' => true, 'msg' => 'Data berhasil dimasukkan keranjang'], 200);
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
        $itemdetail = CartDetail::findOrFail($id);
        $stok = $itemdetail->produk->stok;
        $param = $request->param;

        if ($param == 'inc') {
            // update detail cart
            if ($itemdetail->qty < $stok) {
                $qty = 1;
                $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga);
                // update total cart
                $itemdetail->cart->updatetotal($itemdetail->cart, $itemdetail->harga);
                return response()->json(['success' => true, 'msg' => 'Qty berhasil diupdate'], 200);
            }
            return response()->json(['success' => false, 'msg' => 'Jumlah qty melebihi stok produk'], 500);
        }
        if ($param == 'dec') {
            // update detail cart
            if ($itemdetail->qty > 1) {
                $qty = 1;
                $itemdetail->updatedetail($itemdetail, '-' . $qty, $itemdetail->harga);
                // update total cart
                $itemdetail->cart->updatetotal($itemdetail->cart, '-' . $itemdetail->harga);
                return response()->json(['success' => true, 'msg' => 'Qty berhasil diupdate'], 200);
            }
            return response()->json(['success' => false, 'msg' => 'Qty minimal 1'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemdetail = CartDetail::findOrFail($id);
        // update total cart dulu
        $itemdetail->cart->updatetotal($itemdetail->cart, '-' . $itemdetail->subtotal);
        if ($itemdetail->delete()) {
            $itemcart = Cart::where('user_id', Auth::user()->id)
                ->where('status_cart', 'cart')
                ->first();
            if ($itemcart) {
                if ($itemcart->detail->count() == 0) {
                    Cart::where('user_id', Auth::user()->id)
                        ->where('status_cart', 'cart')
                        ->delete();
                }
            }
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 500);
        }
    }

    public function editAlamat($id)
    {
        $alamatpengiriman = AlamatPengiriman::where('user_id', Auth::user()->id)->orderBy('status', 'DESC')->get();
        $data = CartDetail::findOrFail($id);
        return response()->json(['success' => true, 'html' => view('lp.edit-alamat-produk', compact('alamatpengiriman', 'data'))->render()], 200);
    }

    public function updateAlamat(Request $request, $id)
    {
        $alamatid = $request->alamat_pengiriman_id;
        CartDetail::findOrFail($id)->update([
            'alamat_pengiriman_id' => $alamatid
        ]);
        return back()->with('success', 'Data berhasil diupdate');
    }
}
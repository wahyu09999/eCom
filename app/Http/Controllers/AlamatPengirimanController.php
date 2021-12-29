<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlamatPengirimanRequest;
use App\Models\AlamatPengiriman;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatPengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(AlamatPengirimanRequest $request)
    {
        $payload = $request->only(['nama_penerima', 'no_tlp', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kodepos']);
        $payload['user_id'] = Auth::user()->id;
        $status = $request->status;
        if ($status == 1) {
            AlamatPengiriman::where([
                'user_id' => Auth::user()->id,
                'status' => 1
            ])
                ->update(['status' => 0]);
        }
        $payload['status'] = $status;
        AlamatPengiriman::create($payload);

        $alamatutama = AlamatPengiriman::where([
            'user_id' => Auth::user()->id,
            'status' => 1
        ])->first();
        $cart = Cart::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "cart"
        ])->first();
        if ($alamatutama) {
            CartDetail::where('cart_id', $cart->id)->update([
                'alamat_pengiriman_id' => $alamatutama->id
            ]);
        } else {
            CartDetail::where('cart_id', $cart->id)->update([
                'alamat_pengiriman_id' => null
            ]);
        }

        return back()->with('success', 'Alamat pengiriman berhasil disimpan');
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
        $data = AlamatPengiriman::findOrFail($id);
        return response()->json(['success' => true, 'html' => view('lp.edit-alamat', compact('data'))->render()], 200);
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
        $payload = $request->only(['nama_penerima', 'no_tlp', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kodepos']);
        $payload['user_id'] = Auth::user()->id;
        $status = $request->status;
        if ($status == 1) {
            AlamatPengiriman::where([
                'user_id' => Auth::user()->id,
                'status' => 1
            ])
                ->update(['status' => 0]);
        }
        $payload['status'] = $status;
        AlamatPengiriman::findOrFail($id)->update($payload);

        $alamatutama = AlamatPengiriman::where([
            'user_id' => Auth::user()->id,
            'status' => 1
        ])->first();
        $cart = Cart::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "cart"
        ])->first();
        if ($alamatutama) {
            CartDetail::where([
                'cart_id' => $cart->id,
            ])->update([
                'alamat_pengiriman_id' => $alamatutama->id
            ]);
        } else {
            CartDetail::where([
                'cart_id' => $cart->id,
            ])->update([
                'alamat_pengiriman_id' => null
            ]);
        }
        return back()->with('success', 'Alamat pengiriman berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alamatutama = AlamatPengiriman::where([
            'user_id' => Auth::user()->id,
            'status' => 1
        ])->first();
        $cart = Cart::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "cart"
        ])->first();
        if ($alamatutama) {
            CartDetail::where([
                'cart_id' => $cart->id,
                'alamat_pengiriman_id' => $id
            ])->update([
                'alamat_pengiriman_id' => $alamatutama->id
            ]);
        }
        $alamat = AlamatPengiriman::findOrFail($id);
        $cartcheckout = Cart::where([
            'user_id' => Auth::user()->id,
            'status_cart' => "checkout"
        ])->get();
        foreach ($cartcheckout as $val) {
            foreach ($val->detail as $item) {
                if ($item->alamat_pengiriman_id == $alamat->id) {
                    return response()->json(['success' => false, 'msg' => 'Alamat pengiriman tidak dapat dihapus. Karena masih dalam proses order lain.'], 500);
                }
            }
        }
        $alamat->delete();

        return response()->json(['success' => true], 200);
    }
}
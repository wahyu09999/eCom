<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengiriman;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemcart = Cart::where('user_id', Auth::user()->id)
            ->where('status_cart', 'cart')
            ->first();
        $alamatpengiriman = AlamatPengiriman::where('user_id', Auth::user()->id)->orderBy('status', 'DESC')->get();
        if ($itemcart) {
            if ($itemcart->detail->count() == 0) {
                Cart::where('user_id', Auth::user()->id)
                    ->where('status_cart', 'cart')
                    ->delete();
            }
        }
        return view('lp.cart', compact('itemcart', 'alamatpengiriman'));
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
        //
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
        //
    }

    public function kosongkan($id)
    {
        $itemcart = Cart::findOrFail($id);
        $itemcart->detail()->delete(); //hapus semua item di cart detail
        $itemcart->delete();
        return response()->json(['success', true], 200);
    }

    public function getCount()
    {
        if (Auth::check()) {
            return Cart::getCount(Auth::user()->id);
        }
        return 0;
    }
}
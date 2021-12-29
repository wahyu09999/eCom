<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{

    public function index()
    {
        $produk = Produk::with('kategori')->limit(6)->latest()->get();
        return view('lp.beranda', compact('produk'));
    }

    public function listProduk()
    {
        $produk = Produk::with('kategori')->latest()->paginate(8);
        return view('lp.produk', compact('produk'));
    }

    public function detailProduk($id)
    {
        $produk = Produk::where('id', $id)->with('kategori')->first();
        return view('lp.detail-produk', compact('produk'));
    }

    public function profil()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('lp.profil', compact('user'));
    }

    public function updateProfil(Request $request, $id)
    {
        User::findOrFail($id)->update($request->all());
        return back();
    }

    public function cariProduk(Request $request)
    {
        $key = $request->keywords;
        $produk = Produk::whereHas('kategori', function ($query) use ($key) {
            $query->where('nama', 'like', '%' . $key . '%');
        })
            ->orWhere('nama', 'like', "%" . $key . "%")
            ->orWhere('deskripsi', 'like', "%" . $key . "%")
            ->orWhere('deskripsi', 'like', "%" . $key . "%")
            ->paginate(8);
        $produk->appends([
            'keywords' => $key
        ]);
        return view('lp.produk', compact('produk', 'key'));
    }
}
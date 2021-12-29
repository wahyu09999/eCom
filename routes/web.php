<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AlamatPengirimanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('data-profil', [BerandaController::class, 'profil'])->name('beranda.profil');
Route::put('data-profil/{id}', [BerandaController::class, 'updateProfil'])->name('beranda.updateprofil');
Route::get('produk/list', [BerandaController::class, 'listProduk'])->name('beranda.listproduk');
Route::get('produk/detail/{id}', [BerandaController::class, 'detailProduk'])->name('beranda.detailproduk');
Route::get('cari-produk', [BerandaController::class, 'cariProduk'])->name('beranda.cariProduk');

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function () {
    Route::get('edit-alamat-produk/{id}', [CartDetailController::class, 'editAlamat'])->name('editalamatproduk');
    Route::put('update-alamat-produk/{id}', [CartDetailController::class, 'updateAlamat'])->name('updatealamatproduk');
    Route::put('kosongkan-keranjang/{id}', [CartController::class, 'kosongkan']);
    Route::get('api/get-count-cart', [CartController::class, 'getCount']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('cart', CartController::class);
    Route::get('upload-bukti/{id}', [OrderController::class, 'showUpload'])->name('showupload');
    Route::post('upload-bukti', [OrderController::class, 'uploadBukti'])->name('uploadBukti');
    Route::resource('order', OrderController::class);
    Route::resource('detail-cart', CartDetailController::class);
    Route::resource('alamat-pengiriman', AlamatPengirimanController::class);

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::get('transaksi/cetak', [AdminOrderController::class, 'cetak'])->name('transaksi.cetak');

        Route::resource('dashboard', DashboardController::class)->only(['index']);
        Route::resource('transaksi', AdminOrderController::class);
        Route::resource('user', UserController::class);
        Route::resource('produk', AdminProdukController::class);
        Route::resource('kategori', KategoriController::class);
    });
});
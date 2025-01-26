<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PostController;
use App\Models\User;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

Route::resource('barangkeluars', BarangKeluarController::class);
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rute untuk Barang
Route::resource('barang', BarangController::class);

// Rute untuk Barang Masuk
Route::resource('barang_masuk', BarangMasukController::class);
Route::resource('barangmasuks', BarangMasukController::class);




Route::get('/', function () {
    return view('welcome');
});

Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/transaksis', \App\Http\Controllers\TransaksiController::class);
Route::resource('/laporans', \App\Http\Controllers\LaporanController::class);
Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home',  [UserController::class, 'index'])->name('home');
Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');
Route::post('/laporans/ekspor-pdf', [LaporanController::class, 'eksporPdf'])->name('laporans.eksporPdf');
// Menambahkan route untuk index transaksi
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksis.index');
Route::get('transaksis/{id}', [TransaksiController::class, 'show'])->name('transaksis.show');

Route::get('/', function(){
    return view('welcome');
});
Route::post('/midtrans/callback', [TransaksiController::class, 'callback']);

Route::get('/about', function(){
    return view('about');
});

Route::post('/register', [UserController::class,'register']);
Route::post('/logout', [UserController::class,'logout']);
Route::post('/login', [UserController::class,'login']);
Route::get('/transaksis/{id}/batal', [TransaksiController::class, 'batal'])->name('transaksis.batal');
Route::match(['get', 'post'], '/transaksis/ranking', [TransaksiController::class, 'ranking'])->name('transaksis.ranking');


// Rute Barang
Route::resource('/barang', BarangController::class);
Route::get('/barang/{id}/detail', [BarangController::class, 'detail'])->name('barangs.detail');
Route::post('/barang/{id}/update-stok', [BarangController::class, 'updateStok'])->name('barangs.updateStok');
Route::get('/barang/filter', [BarangController::class, 'filter'])->name('barangs.filter');
Route::resource('barangs', BarangController::class);
// Rute Barang Masuk
Route::resource('/barang_masuk', BarangMasukController::class);
Route::get('/barang_masuk/{id}/detail', [BarangMasukController::class, 'detail'])->name('barang_masuks.detail');
Route::post('/barang_masuk/{id}/konfirmasi', [BarangMasukController::class, 'konfirmasi'])->name('barang_masuks.konfirmasi');
Route::match(['get', 'post'], '/barang_masuk/filter', [BarangMasukController::class, 'filter'])->name('barang_masuks.filter');

Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barangkeluars.create');
Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barangkeluars.create');
Route::resource('/barang_keluar', BarangKeluarController::class);
Route::post('/barang_keluar/{id}/konfirmasi', [BarangKeluarController::class, 'konfirmasi'])->name('barangkeluars.konfirmasi');
Route::get('/barang_keluar/filter', [BarangKeluarController::class, 'filter'])->name('barangkeluars.filter');
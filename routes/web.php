<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PostController;
use App\Models\User;



Route::get('/', function () {
    return view('welcome');
});

Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/transaksis', \App\Http\Controllers\TransaksiController::class);
Route::resource('/laporans', \App\Http\Controllers\LaporanController::class);
Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home',  [UserController::class, 'index'])->name('home');
Route::get('/laporans', [LaporanController::class, 'index'])->name('laporans.index');

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


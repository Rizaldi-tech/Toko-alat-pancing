<?php

namespace App\Http\Controllers;

use App\Models\Product; // Pastikan model Product sudah di-import
use App\Models\transaksi;
use App\Models\laporan;


class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $transaksis = Transaksi::all();
        $laporans = Laporan::all();
       
        return view('dashboard', compact('products', 'transaksis', 'laporans'));
    }
    }

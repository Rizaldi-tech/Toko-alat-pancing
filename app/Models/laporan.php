<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'transaksi_id',
        'admin_id',
        'pelanggan_id',
        'Tanggal',
        'Pendapatan',
        'Jumlah_barang',
    ];

}

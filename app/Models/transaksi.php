<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',        // ID produk yang terkait
        'Tanggal_transaksi', // Tanggal transaksi
        'Nama_pembeli',      // Nama pembeli
        'Jumlah_barang',     // Jumlah barang yang dibeli
        'Total_pembayaran'   // Total pembayaran transaksi
    ];

    public function product()
    {
        return $this->belongsTo(Product::class); // Relasi ke model Product
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
        'stok',  // Kolom untuk jumlah stok
        'harga', // Kolom untuk harga produk
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}

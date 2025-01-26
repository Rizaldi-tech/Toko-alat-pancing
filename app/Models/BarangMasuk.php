<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk'; // Nama tabel di database
    protected $fillable = ['Nama_barang', 'Tanggal']; // Kolom yang bisa diisi
}

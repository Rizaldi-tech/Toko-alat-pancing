<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluar'; // Nama tabel di database (dengan huruf kecil)
    protected $fillable = ['Nama_barang', 'Tanggal']; // Kolom yang bisa diisi
}
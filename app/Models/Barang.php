<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan
    protected $table = 'barangss'; // Nama tabel sesuai di database

    // Menentukan kolom yang bisa diisi
    protected $fillable = ['title', 'quantity', 'received_date'];
}

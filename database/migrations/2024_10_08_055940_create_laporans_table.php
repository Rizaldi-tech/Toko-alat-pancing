<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('Tanggal');
            $table->bigInteger('Pendapatan');
            $table->bigInteger('Jumlah_barang');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }

};

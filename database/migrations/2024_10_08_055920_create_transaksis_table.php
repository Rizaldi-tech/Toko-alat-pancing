<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->date('Tanggal_transaksi');
            $table->string('Nama_pembeli');
            $table->integer('Jumlah_barang');
            $table->decimal('Total_pembayaran', 15, 2);
            $table->string('status')->default('pending');
            $table->string('snap_token')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
}

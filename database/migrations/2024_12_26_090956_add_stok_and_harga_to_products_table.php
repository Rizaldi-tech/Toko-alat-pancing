<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('stok')->default(0)->after('price'); // Menambahkan kolom stok
            $table->decimal('harga', 10, 2)->default(0)->after('stok'); // Menambahkan kolom harga
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('stok');
            $table->dropColumn('harga');
        });
    }
};

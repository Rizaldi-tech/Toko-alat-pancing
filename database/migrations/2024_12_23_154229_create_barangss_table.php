<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDescriptionAndPriceFromBarangssTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('barangss', function (Blueprint $table) {
            $table->dropColumn('description'); // Menghapus kolom description
            $table->dropColumn('price'); // Menghapus kolom price
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangss', function (Blueprint $table) {
            $table->text('description'); // Menambahkan kembali kolom description
            $table->bigInteger('price'); // Menambahkan kembali kolom price
        });
    }
}

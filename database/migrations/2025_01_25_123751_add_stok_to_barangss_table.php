<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barangss', function (Blueprint $table) {
            $table->integer('stok')->default(0); // Default value 0 jika tidak diisi
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barangss', function (Blueprint $table) {
            //
        });
    }
};

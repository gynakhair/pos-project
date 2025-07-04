<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('barcode')->unique(); // untuk scanning
        $table->integer('stok');
        $table->decimal('harga', 10, 2);
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

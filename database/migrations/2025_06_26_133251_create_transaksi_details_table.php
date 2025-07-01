<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi_details', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('transaksi_id');
        $table->unsignedBigInteger('produk_id');
        $table->integer('qty');
        $table->decimal('harga', 12, 0);
        $table->timestamps();

        $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
        $table->foreign('produk_id')->references('id')->on('products')->onDelete('cascade');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_details');
    }
};

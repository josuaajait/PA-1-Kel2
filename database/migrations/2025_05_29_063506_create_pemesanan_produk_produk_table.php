<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanan_produk_produk', function (Blueprint $table) {
            // Sesuaikan foreign key ke kolom custom 'pemesanan_produk_id'
            $table->unsignedBigInteger('pemesanan_produk_id');
            $table->foreign('pemesanan_produk_id')->references('pemesanan_produk_id')->on('pemesanan_produks')->onDelete('cascade');

            $table->unsignedBigInteger('produk_id');
            $table->foreign('produk_id')->references('produk_id')->on('produks')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanan_produk_produk');
    }
};

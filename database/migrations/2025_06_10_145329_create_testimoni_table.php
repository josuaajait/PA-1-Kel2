<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('testimonis', function (Blueprint $table) {
            $table->id('testimoni_id');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('rate'); // 1–5
            $table->text('deskripsi');
            $table->string('gambar_testimoni')->nullable(); // Kolom gambar
            $table->unsignedBigInteger('pemesanan_jahitan_id')->nullable();
            $table->unsignedBigInteger('pemesanan_produk_id')->nullable();
            $table->unsignedBigInteger('modifikasi_jahitan_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('pemesanan_jahitan_id')->references('pemesanan_jahitan_id')->on('pemesanan_jahitans')->onDelete('set null');
            $table->foreign('pemesanan_produk_id')->references('pemesanan_produk_id')->on('pemesanan_produks')->onDelete('set null');
            $table->foreign('modifikasi_jahitan_id')->references('modifikasi_jahitan_id')->on('modifikasi_jahitans')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('testimonis');
    }
};

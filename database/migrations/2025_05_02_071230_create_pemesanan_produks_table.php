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
        Schema::create('pemesanan_produks', function (Blueprint $table) {
            $table->id('pemesanan_produk_id'); // Primary key custom
            $table->string('jenis_pakaian');
            $table->string('nama');
            $table->string('email');
            $table->string('nomor_telepon');
            $table->text('alamat');
            $table->decimal('total_harga', 10, 2)->default(0);
            $table->enum('status', ['diproses', 'dibatalkan', 'selesai'])->default('diproses');

            // Foreign key ke users.user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_produks');
    }
};

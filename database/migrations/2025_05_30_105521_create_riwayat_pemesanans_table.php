<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('riwayat_pemesanans', function (Blueprint $table) {
            $table->id('riwayat_pemesanan_id');

            // Foreign keys opsional
            $table->unsignedBigInteger('pemesanan_produk_id')->nullable();
            $table->foreign('pemesanan_produk_id')->references('pemesanan_produk_id')->on('pemesanan_produks')->onDelete('set null');

            $table->unsignedBigInteger('pemesanan_jahitan_id')->nullable();
            $table->foreign('pemesanan_jahitan_id')->references('pemesanan_jahitan_id')->on('pemesanan_jahitans')->onDelete('set null');

            // Tambahan: relasi ke modifikasi_jahitans
            $table->unsignedBigInteger('modifikasi_jahitan_id')->nullable();
            $table->foreign('modifikasi_jahitan_id')->references('modifikasi_jahitan_id')->on('modifikasi_jahitans')->onDelete('set null');

            // Informasi umum
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->text('alamat');

            // Tipe pemesanan: produk, jahitan, atau modifikasi
            $table->enum('jenis_pemesanan', ['produk', 'jahitan', 'modifikasi']);

            // Data tambahan untuk produk dan modifikasi
            $table->string('jenis_pakaian')->nullable();
            $table->decimal('total_harga', 10, 2)->nullable();

            // Data tambahan untuk jahitan
            $table->string('bahan')->nullable();
            $table->string('warna')->nullable();
            $table->text('ukuran')->nullable();
            $table->string('referensi_gambar')->nullable();

            // Bukti pembayaran
            $table->string('bukti_pembayaran_uang_muka');
            $table->string('bukti_pembayaran_lunas')->nullable();

            // Status
            $table->enum('status', ['pending', 'diproses', 'dibatalkan', 'selesai'])->default('pending');

            $table->timestamps();

            // Relasi user
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_pemesanans');
    }
};

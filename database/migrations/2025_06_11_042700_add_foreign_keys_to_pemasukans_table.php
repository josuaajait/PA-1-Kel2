<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemasukans', function (Blueprint $table) {
            // Tambahkan kolom foreign key (nullable agar fleksibel)
            $table->unsignedBigInteger('pemesanan_produk_id')->nullable()->after('jumlah');
            $table->unsignedBigInteger('pemesanan_jahitan_id')->nullable()->after('pemesanan_produk_id');

            // Definisikan relasi
            $table->foreign('pemesanan_produk_id')
                ->references('pemesanan_produk_id')
                ->on('pemesanan_produks')
                ->onDelete('set null');

            $table->foreign('pemesanan_jahitan_id')
                ->references('pemesanan_jahitan_id')
                ->on('pemesanan_jahitans')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('pemasukans', function (Blueprint $table) {
            // Drop foreign keys dulu
            $table->dropForeign(['pemesanan_produk_id']);
            $table->dropForeign(['pemesanan_jahitan_id']);

            // Drop kolom
            $table->dropColumn('pemesanan_produk_id');
            $table->dropColumn('pemesanan_jahitan_id');
        });
    }
};

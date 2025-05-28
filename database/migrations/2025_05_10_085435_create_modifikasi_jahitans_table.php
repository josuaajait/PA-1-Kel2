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
    Schema::create('modifikasi_jahitans', function (Blueprint $table) {
        $table->id();

        // Foreign Key ke tabel pemesanan_jahitans
        $table->unsignedBigInteger('pemesanan_jahitan_id')->nullable();
        $table->foreign('pemesanan_jahitan_id')->references('id')->on('pemesanan_jahitans')->onDelete('set null');

        // Foreign Key ke tabel pemesanan_produks
        $table->unsignedBigInteger('pemesanan_produk_id')->nullable();
        $table->foreign('pemesanan_produk_id')->references('id')->on('pemesanan_produks')->onDelete('set null');
        
        $table->string('nama');
        $table->string('jenis_pakaian');
        $table->text('catatan');

        $table->unsignedBigInteger('user_id'); // Kolom untuk foreign key
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifikasi_jahitans');
    }
};

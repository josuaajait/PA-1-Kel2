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
    Schema::create('pemesanan_produks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produk_id')->constrained('produks')->onDelete('cascade');  // Relasi ke produk
        $table->string('jenis_pakaian');
        $table->string('nama');
        $table->string('email');
        $table->string('nomor_telepon');
        $table->text('alamat');
        $table->integer('jumlah');
        $table->decimal('total_harga', 10, 2);
        $table->enum('status', ['pending', 'diproses', 'selesai'])->default('pending');

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
        Schema::dropIfExists('pemesanan_produks');
    }
};

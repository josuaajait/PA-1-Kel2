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
        Schema::create('pemasukans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal pemasukan
            $table->string('sumber'); // Sumber: Pemesanan Jahitan, Pemesanan Produk, Lainnya
            $table->text('keterangan'); // Deskripsi pemasukan, misal: "DP Invoice #123"
            $table->decimal('jumlah', 15, 2); // Jumlah uang, bisa menampung angka besar
            $table->timestamps(); // Otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukans');
    }
};
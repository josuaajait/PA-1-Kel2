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
        Schema::create('modifikasi_jahitans', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Nama (misal: Permak Celana, Ubah Ukuran Kemeja)
            $table->text('catatan')->nullable(); // Catatan detail modifikasi (opsional)
            $table->string('jenis_pakaian'); // Jenis pakaian yang dimodifikasi
            $table->timestamps(); // created_at and updated_at
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

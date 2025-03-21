<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('email');
                $table->string('nomor_telepon');
                $table->string('alamat');
                $table->string('jenis_pakaian');
                $table->string('ukuran');
                $table->string('warna');
                $table->string('modifikasi');
                $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai']);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

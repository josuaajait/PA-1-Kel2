<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pemesanan_jahitans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('jenis_pakaian');
            $table->string('bahan');
            $table->string('warna');
            $table->text('ukuran');
            $table->enum('status', ['pending', 'selesai'])->default('pending');
            $table->string('referensi_gambar')->nullable();

            $table->unsignedBigInteger('user_id'); // Kolom untuk foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemesanan_jahitans');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->unsignedBigInteger('produk_id')->autoIncrement();
            $table->string('nama');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->string('gambar');
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->string('ukuran')->nullable();  
            $table->string('warna')->nullable();   
            $table->string('bahan')->nullable();

            $table->unsignedBigInteger('user_id'); // Kolom untuk foreign key
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produks');
    }
}

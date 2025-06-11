<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('ukuran_pakaian', function (Blueprint $table) {
            $table->id('ukuran_id');
            $table->unsignedBigInteger('pemesanan_jahitan_id');
            
            // Kolom-kolom ukuran umum
            $table->float('lingkar_dada')->nullable();
            $table->float('lingkar_pinggang')->nullable();
            $table->float('lingkar_pinggul')->nullable();
            $table->float('panjang_baju')->nullable();
            $table->float('panjang_lengan')->nullable();
            $table->float('lebar_bahu')->nullable();
            $table->float('lingkar_lengan')->nullable();
            $table->float('lingkar_pergelangan')->nullable();
            $table->float('tinggi_badan')->nullable();

            $table->timestamps();

            $table->foreign('pemesanan_jahitan_id')
                  ->references('pemesanan_jahitan_id')
                  ->on('pemesanan_jahitans')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ukuran_pakaian');
    }
};

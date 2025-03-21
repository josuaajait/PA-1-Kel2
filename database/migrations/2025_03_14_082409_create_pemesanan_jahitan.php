<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jahitan_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->text('address');
            $table->string('jenis');
            $table->string('bahan');
            $table->string('warna');
            $table->text('modifikasi');

            // Measurement Fields
            $table->decimal('lingkar_leher', 5, 2)->nullable();
            $table->decimal('lebar_bahu', 5, 2)->nullable();
            $table->decimal('lingkar_dada', 5, 2)->nullable();
            $table->decimal('lingkar_pinggang', 5, 2)->nullable();
            $table->decimal('panjang_lengan', 5, 2)->nullable();
            $table->decimal('panjang_kemeja', 5, 2)->nullable();
            $table->decimal('lingkar_pinggul', 5, 2)->nullable();
            $table->decimal('panjang_tangan', 5, 2)->nullable();
            $table->decimal('lingkar_lengan_atas', 5, 2)->nullable();
            $table->decimal('panjang_bada', 5, 2)->nullable();
            $table->decimal('panjang_badan', 5, 2)->nullable();
            $table->decimal('panjang_gaun', 5, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jahitan_orders');
    }
};

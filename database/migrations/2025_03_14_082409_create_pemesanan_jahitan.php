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
            $table->text('ukuran');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jahitan_orders');
    }
};

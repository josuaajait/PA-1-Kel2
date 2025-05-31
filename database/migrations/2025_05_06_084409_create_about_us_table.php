<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id('about_us_id'); // Kolom untuk ID unik
            $table->text('deskripsi');  // Deskripsi about us
            $table->text('sejarah');    // Sejarah about us
            $table->text('visi');       // Visi about us
            $table->text('misi');       // Misi about us
            $table->boolean('is_active')->default(true); // To show or hide this entry

            $table->unsignedBigInteger('user_id'); // Kolom untuk foreign key
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_us');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('modifikasis')) {
            Schema::create('modifikasis', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pemesanan_id')->constrained()->onDelete('cascade');
                $table->string('nama');
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

    public function down()
    {
        Schema::dropIfExists('modifikasis');
    }

    public function getConnection()
    {
        return config('modifikasi.database_connection');
    }

    public function getSchema()
    {
        return config('modifikasi.database_schema');
    }

    public function getTable()
    {
        return config('modifikasi.database_table');
    }

    public function getKeyName()
    {
        return config('modifikasi.database_primary_key');
    }

    public function getForeignKey()
    {
        return config('modifikasi.database_foreign_key');
    }

    public function getCreatedAt()
    {
        return config('modifikasi.database_created_at');
    }

    public function getUpdatedAt()
    {
        return config('modifikasi.database_updated_at');
    }
};

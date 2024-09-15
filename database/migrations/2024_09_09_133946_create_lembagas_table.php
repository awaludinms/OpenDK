<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::create('das_lembaga', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lembaga')->nullable();
            $table->string('kode_lembaga')->nullable();
            $table->string('nomor_sk_pendirian_lembaga')->nullable();
            $table->integer('das_kategori_lembaga_id')->nullable();
            $table->integer('penduduk_id')->nullable();
            $table->text('deskripsi_lembaga')->nullable();
            $table->text('logo_lembaga')->nullable();
            $table->integer('jumlah_anggota_lembaga')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('das_lembagas');
    }
};

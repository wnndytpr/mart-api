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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk');
            $table->string('nama_produk');
            $table->unsignedBigInteger('harga'); 
            //Integer → angka bulat (nggak ada koma).
            //Big → bisa nyimpen angka yang sangat besar.
            //Unsigned → artinya nggak boleh minus (cuma boleh dari 0 ke atas).
            //contoh : Kalau kamu pakai unsignedBigInteger, datanya bisa dari 0 sampai 18.446.744.073.709.551.615 (gede banget kan).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
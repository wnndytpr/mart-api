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
        Schema::create('token_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id');
            $table->string('auth_key');
            $table->timestamps();

            $table->foreign('anggota_id')
                    ->references('id')
                    ->on('anggota')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_anggota');
    }
};
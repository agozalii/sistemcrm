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
        Schema::create('klasifikasigunung', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama_gunung');
            $table->string('gambar_gunung');
            $table->enum('ketinggian', ['Rendah', 'Sedang', 'Tinggi']);
            $table->enum('kesulitan', ['Rendah', 'Sedang', 'Tinggi']);
            $table->enum('lama_pendakian', ['Pendek', 'Sedang', 'Panjang']);
            $table->enum('suhu', ['Dingin', 'Sedang', 'Hangat']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klasifikasigunung');
    }
};

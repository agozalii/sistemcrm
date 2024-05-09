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
            $table->string('id')->primary();
            $table->string('nama_produk');
            $table->string('gambar_produk');
            $table->integer('harga_produk');
            $table->enum('kategori', ['Pakaian & Celana', 'Peralatan Outdoor', 'Peralatan Keamanan', 'Sepatu & Sandal', 'Ransel', 'Jaket & Jas Hujan']);
            $table->text('deskripsi');
            $table->enum('merk', ['Consina', 'Forester']);
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
        Schema::dropIfExists('produk');
    }
};

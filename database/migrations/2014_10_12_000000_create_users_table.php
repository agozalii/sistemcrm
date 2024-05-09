<?php

use App\Models\TransaksiModel;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->increments('id');
            $table->string('username')-> unique();
            $table->string('password');
            $table->enum('role', ['admin','kasir','member','manajer']);
            $table->string('nama');
            $table->text('alamat');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['L','P']);
            $table->char('email');
            $table->char('nomor_telpon');
            $table->string('point', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

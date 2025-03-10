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
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();
            $table->string('rekening')->unique();
            $table->string('cabang')->nullable();
            $table->string('unit')->nullable();
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('plafond')->nullable();
            $table->string('jenis_agunan')->nullable();
            $table->string('kondisi')->nullable();
            $table->integer('pokok')->nullable();
            $table->integer('bunga')->nullable();
            $table->integer('kolek')->nullable();
            $table->date('tanggal_permohonan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nasabahs');
    }
};

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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapel_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('angkatan_id');
            $table->double('tugas1');
            $table->double('tugas2');
            $table->double('tugas3');
            $table->double('ujian');
            $table->foreign('mapel_id')->references('id')->on('mapels');
            $table->foreign('siswa_id')->references('id')->on('siswas');
            $table->foreign('angkatan_id')->references('id')->on('angkatans');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};

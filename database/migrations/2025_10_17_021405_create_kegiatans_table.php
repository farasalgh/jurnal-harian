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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->constrained('siswas')->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('mulai_kegiatan');
            $table->time('selesai_kegiatan');
            $table->string('dokumentasi')->nullable();
            $table->text('catatan_pembimbing')->nullable();
            $table->text('keterangan_kegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};

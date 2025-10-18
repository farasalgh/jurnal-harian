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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users')->cascadeOnDelete();
            $table->foreignId('id_kelas')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('id_jurusan')->constrained('jurusans')->cascadeOnDelete();
            $table->string('nis', 10)->unique();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir');
            $table->enum('gender', ['laki-laki', 'perempuan']);
            $table->string('gol_darah');
            $table->text('alamat')->nullable();
            $table->string('nomor');
            $table->foreignId('id_dudi')->constrained('dudis')->cascadeOnDelete();
            $table->foreignId('id_pembimbing')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelatihan_id')->constrained()->onDelete('cascade'); // Relasi ke pelatihan
            $table->string('name'); // Nama Materi
            $table->string('kode_materi')->unique(); // Kode Materi Unik
            $table->string('file_path')->nullable(); // File (PDF/PPT) opsional
            $table->string('link')->nullable(); // Link YouTube opsional
            $table->timestamps();
        });
    }

    /**
     * Reverse migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('materis');
    }
};
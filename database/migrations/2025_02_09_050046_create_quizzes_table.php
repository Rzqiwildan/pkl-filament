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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bagian_pelatihan_id')->constrained()->onDelete('cascade'); // Quiz terkait dengan bagian pelatihan
            $table->string('title'); // Judul Quiz
            $table->text('description')->nullable(); // Deskripsi Quiz
            $table->integer('duration')->default(30); // Durasi Quiz dalam Menit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
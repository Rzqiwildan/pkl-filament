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
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kesulitan');
            $table->string('jenis');
            $table->text('deskripsi');
            $table->string('thumbnail');
            $table->string('harga');
            $table->integer('kapasitas');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('materi_id')->constrained('materis')->onDelete('restrict');
            $table->foreignId('jadwal_id')->constrained('jadwal_pelatihans')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('email');
            $table->foreign('email')->references('email')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihans');
    }
};
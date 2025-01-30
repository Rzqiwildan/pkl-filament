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
        Schema::table('jadwal_pelatihans', function (Blueprint $table) {
            Schema::table('jadwal_pelatihans', function (Blueprint $table) {
                $table->string('jadwal')->nullable();  // Sesuaikan dengan tipe data yang diperlukan
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_pelatihan', function (Blueprint $table) {
            //
        });
    }
};
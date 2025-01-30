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
        Schema::table('pelatihans', function (Blueprint $table) {
            //
        });

        Schema::table('jadwal_pelatihans', function (Blueprint $table) {
            // Menambahkan kolom pelatihan_id
            $table->unsignedBigInteger('pelatihan_id')->nullable()->after('id'); 

            // Menambahkan foreign key yang menghubungkan ke tabel pelatihans
            $table->foreign('pelatihan_id')->references('id')->on('pelatihans')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihans', function (Blueprint $table) {
            //
        });

        Schema::table('pelatihans', function (Blueprint $table) {
            // Menghapus foreign key dan kolom jika rollback dilakukan
            $table->dropForeign(['pelatihan_id']);
            $table->dropColumn('pelatihan_id');
        });
    }
};

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
            // Menambahkan kolom teacher_id yang akan menjadi foreign key
            $table->unsignedBigInteger('teacher_id')->nullable(); // Nullable jika kamu ingin membiarkan beberapa data tanpa teacher_id
            // Menambahkan foreign key constraint untuk teacher_id
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null'); // Mengatur apa yang terjadi jika teacher dihapus (misal: set null)

            // Mengubah kolom jadwal_id menjadi foreign key yang merujuk ke jadwal_pelatihans
            $table->foreign('jadwal_id')->references('id')->on('jadwal_pelatihans')->onDelete('restrict'); // Menambahkan foreign key ke jadwal_pelatihans
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelatihans', function (Blueprint $table) {
            // Menghapus foreign key dan kolom yang ditambahkan
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['jadwal_id']);
            $table->dropColumn('teacher_id');
        });
    }
};
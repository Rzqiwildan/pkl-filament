<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan perubahan pada tabel `pelatihans`
     */
    public function up(): void
    {
        Schema::table('pelatihans', function (Blueprint $table) {
            // Hapus foreign key jika ada
            $table->dropForeign(['materi_id']);
            // Hapus kolom materi_id dari tabel pelatihans
            $table->dropColumn('materi_id');
        });
    }

    /**
     * Rollback perubahan jika dibutuhkan
     */
    public function down(): void
    {
        Schema::table('pelatihans', function (Blueprint $table) {
            // Tambahkan kembali kolom materi_id
            $table->foreignId('materi_id')->constrained()->onDelete('cascade');
        });
    }
};
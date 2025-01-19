<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah tipe kolom role menjadi string sementara
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(255)");
        
        // Mengubah kembali ke enum dengan nilai yang baru
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin','user','teacher','mahasiswa','umum') DEFAULT 'user'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengubah tipe kolom role menjadi string sementara
        DB::statement("ALTER TABLE users MODIFY role VARCHAR(255)");
        
        // Mengembalikan ke enum awal
        DB::statement("ALTER TABLE users MODIFY role ENUM('admin','user','teacher') DEFAULT 'user'");
    }
};
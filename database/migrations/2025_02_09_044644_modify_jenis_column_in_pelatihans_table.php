<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pelatihans', function (Blueprint $table) {
            $table->string('jenis', 10)->default('online')->change(); // Ubah ENUM ke STRING
        });
    }

    public function down(): void
    {
        Schema::table('pelatihans', function (Blueprint $table) {
            $table->enum('jenis', ['online', 'offline'])->default('online')->change();
        });
    }
};
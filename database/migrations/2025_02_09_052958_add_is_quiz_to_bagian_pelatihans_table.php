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
        Schema::table('bagian_pelatihans', function (Blueprint $table) {
            $table->boolean('is_quiz')->default(false)->after('nama_bagian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bagian_pelatihans', function (Blueprint $table) {
            $table->dropColumn('is_quiz');
        });
    }
};
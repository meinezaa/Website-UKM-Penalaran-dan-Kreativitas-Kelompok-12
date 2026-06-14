<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumentasi_kegiatan', function (Blueprint $blueprint) {
            // Mengubah tipe kolom foto dari VARCHAR menjadi TEXT
            $blueprint->text('foto')->change();
        });
    }

    public function down(): void
    {
        Schema::table('dokumentasi_kegiatan', function (Blueprint $blueprint) {
            $blueprint->string('foto', 255)->change();
        });
    }
};
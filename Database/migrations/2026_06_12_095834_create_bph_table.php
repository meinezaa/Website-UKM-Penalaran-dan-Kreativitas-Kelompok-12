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
        Schema::create('bph', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Nama pengurus (Mayla Zaskia K, dll)
            $table->string('role');         // Jabatan (Ketua Umum, Sekretaris, Bendahara)
            $table->string('major_year');   // Prodi & Angkatan (Ekonomi Pembangunan '24)
            $table->string('photo');        // Nama file foto (ketuaumum.png)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bph');
    }
};
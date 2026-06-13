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
        Schema::create('dokumentasi_kegiatan', function (Blueprint $table) {
            $table->id('id_dokumentasi');
            
            // Membuat foreign key yang otomatis sinkron dengan tipe BIGINT UNSIGNED tabel kegiatan
            $table->foreignId('id_kegiatan')
                  ->constrained('kegiatan', 'id_kegiatan')
                  ->onDelete('cascade');
                  
            $table->string('judul_foto', 150)->nullable();
            $table->string('foto', 255);
            $table->text('deskripsi')->nullable();
            $table->timestamps(); // Otomatis membuat created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_kegiatan');
    }
};
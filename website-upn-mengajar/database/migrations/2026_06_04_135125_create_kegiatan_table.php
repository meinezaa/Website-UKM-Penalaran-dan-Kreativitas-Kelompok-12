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
        Schema::create('kegiatan', function (Blueprint $table) {
    $table->id('id_kegiatan');
    $table->unsignedBigInteger('id_user');
    $table->string('foto_kegiatan')->nullable();
    $table->string('nama_kegiatan');
    $table->string('kategori'); // sd, slb, yayasan
    $table->date('tanggal_pelaksanaan')->nullable();
    $table->string('jam_kegiatan')->nullable();
    $table->date('batas_registrasi')->nullable();
    $table->string('lokasi')->nullable();
    $table->text('alamat_lengkap')->nullable();
    $table->text('detail_aktivitas')->nullable();
    $table->text('deskripsi_detail')->nullable();
    $table->string('status_kegiatan')->default('aktif');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};

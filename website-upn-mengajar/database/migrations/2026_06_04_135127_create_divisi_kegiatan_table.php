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
        Schema::create('pendaftaran_relawan', function (Blueprint $table) {
    $table->id('id_pendaftaran');
    $table->unsignedBigInteger('id_user');
    $table->unsignedBigInteger('id_kegiatan');
    $table->string('no_hp');
    $table->integer('umur');
    $table->string('jenis_kelamin');
    $table->string('asal_prodi');
    $table->string('pilihan_divisi_1');
    $table->string('pilihan_divisi_2')->nullable();
    $table->string('portofolio')->nullable();
    $table->text('pengalaman_keahlian')->nullable();
    $table->string('metode_pembayaran');
    $table->string('bukti_pembayaran');
    $table->string('status_seleksi')->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi_kegiatans');
    }
};

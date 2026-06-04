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
        Schema::create('divisi_kegiatan', function (Blueprint $table) {
    // Primary Key: int(11) NOT NULL AUTO_INCREMENT
    $table->id('id_divisi_kegiatan'); 
    
    // Foreign Key: int(11) NOT NULL (diselaraskan ke unsignedBigInteger agar bisa relasi)
    $table->unsignedBigInteger('id_kegiatan'); 
    
    // Enum lengkap sesuai isi SQL kamu
    $table->enum('nama_divisi', [
        'Sekretaris', 
        'Bendahara', 
        'Acara', 
        'Humas', 
        'Perkap', 
        'Pendamping', 
        'PDD', 
        'Sponsorship'
    ]); 
    
    // Kuota: int(11) DEFAULT 0
    $table->integer('kuota')->default(0); 
    
    // Jobdesc: text DEFAULT NULL
    $table->text('jobdesc')->nullable(); 
    
    // Otomatis membuat kolom created_at dan updated_at (opsional, khas Laravel)
    $table->timestamps(); 

    // CONSTRAINT divisi_kegiatan_ibfk_1 FOREIGN KEY ... ON DELETE CASCADE
    $table->foreign('id_kegiatan')
          ->references('id_kegiatan')
          ->on('kegiatan')
          ->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisi_kegiatan');
    }
};

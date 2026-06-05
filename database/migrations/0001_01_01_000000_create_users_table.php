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
        Schema::create('users', function (Blueprint $table) {
            // Primary Key sesuai dengan kustomisasi di Model ($primaryKey = 'id_user')
            $table->id('id_user');
            
            // Kolom yang didaftarkan di $fillable Model User
            $table->string('nama_lengkap');
            $table->string('email')->unique(); // Dibuat unik agar email tidak bisa kembar
            $table->string('password');
            
            // Kolom role, bisa menggunakan enum agar pilihannya konsisten (misal: admin dan user)
            $table->enum('role', ['admin', 'user'])->default('user');
            
            // Kolom opsional khas bawaan Laravel untuk fitur 'Remember Me' saat login
            $table->rememberToken();
            
            // Otomatis membuat kolom created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
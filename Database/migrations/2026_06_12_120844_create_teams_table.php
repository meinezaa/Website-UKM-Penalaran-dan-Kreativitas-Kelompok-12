<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->string('nama');
            $table->string('jabatan');
            $table->string('kategori'); // bph / staf_ahli

            $table->string('foto')->nullable();

            $table->string('instagram')->nullable();
            $table->string('email')->nullable();
            $table->string('linkedin')->nullable();

            $table->integer('urutan')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
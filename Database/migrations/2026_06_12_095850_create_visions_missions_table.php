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
        Schema::create('visions_missions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['visi', 'misi']); // Pembeda antara baris visi dan misi
            $table->text('content');                // Teks pernyataan visi/misi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visions_missions');
    }
};
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara eksplisit
    protected $table = 'teams';

    // Menentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama',
        'jabatan',
        'kategori',
        'foto',
        'instagram',
        'email',
        'linkedin',
        'urutan'
    ];

    // Menentukan kolom yang tidak boleh diisi secara massal untuk keamanan
    protected $guarded = ['id'];
}
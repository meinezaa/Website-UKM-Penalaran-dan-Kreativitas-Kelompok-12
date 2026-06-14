<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    /**
     * Menentukan nama tabel di database secara eksplisit.
     * Tabel 'teams' ini sesuai dengan yang ada di phpMyAdmin kamu.
     *
     * @var string
     */
    protected $table = 'teams';

    /**
     * Menentukan kolom mana saja yang boleh diisi secara massal (Mass Assignment).
     * Semua kolom ini sudah disesuaikan dengan struktur tabel di database kamu.
     *
     * @var array<int, string>
     */
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
}
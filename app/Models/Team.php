<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
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
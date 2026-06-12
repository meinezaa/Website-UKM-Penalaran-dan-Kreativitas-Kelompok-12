<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    // Nama tabel di database
    protected $table = 'divisions';

    // Relasi: Satu divisi memiliki banyak program kerja
    public function programs()
    {
        return $this->hasMany(Program::class, 'division_id');
    }
}
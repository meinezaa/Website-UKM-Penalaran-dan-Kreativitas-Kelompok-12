<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    // Nama tabel di database
    protected $table = 'programs';

    // Relasi balik: Program ini dimiliki oleh sebuah divisi
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
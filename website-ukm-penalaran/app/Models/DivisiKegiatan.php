<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DivisiKegiatan extends Model
{
    protected $table = 'divisi_kegiatan';
    protected $primaryKey = 'id_divisi_kegiatan';
    public $timestamps = false;

    protected $fillable = [
        'id_kegiatan', 'nama_divisi', 'kuota', 'jobdesc'
    ];
}
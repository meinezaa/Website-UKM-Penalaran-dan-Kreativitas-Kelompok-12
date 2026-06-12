<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    // Beritahu Laravel bahwa model ini memegang tabel 'visions_missions'
    protected $table = 'visions_missions'; 

    // Izinkan semua kolom diisi data
    protected $guarded = []; 
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bph extends Model
{
    // Beritahu nama tabelnya adalah 'bph'
    protected $table = 'bph'; 

    protected $fillable = ['name', 'role', 'major_year', 'photo'];
    
    protected $guarded = []; 
}
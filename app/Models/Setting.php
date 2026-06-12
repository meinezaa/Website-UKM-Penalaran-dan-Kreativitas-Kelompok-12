<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Beritahu nama tabelnya adalah 'settings'
    protected $table = 'settings'; 

    protected $guarded = []; 
}
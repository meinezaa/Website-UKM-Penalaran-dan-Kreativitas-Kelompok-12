<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user'; // Menyesuaikan primary key databasemu

    protected $fillable = [
        'nama_lengkap',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
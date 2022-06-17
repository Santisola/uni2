<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;

class Admin extends User
{
    protected $table = 'admins';

    protected $primaryKey = 'id_admin';

    protected $fillable = [
      'nombre',
      'email',
      'role',
      'created_at',
      'updated_at'
    ];

    protected $hidden = [
        'password'
    ];
}

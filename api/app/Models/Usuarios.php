<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use SoftDeletes;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'email',
        'imagen',
        'created_at',
        'updated_at',
        'telefono'
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}

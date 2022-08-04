<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'password',
    ];

    public static $reglas = [
        'nombre'=>'required',
        'email'=>'required|email:rfc',
        'telefono'=>'required',
        'password'=>'required',
    ];

    public static $mensajesDeError = [
        'nombre.required'=>'El nombre es obligatorio',
        'email.required'=>'El email es obligatorio',
        'email.email'=>'El email debe ser de un formato válido (nombre@dominio.extension)',
        'telefono.required'=>'El teléfono es obligatorio',
        'password.required'=>'La contraseña es obligatoria',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

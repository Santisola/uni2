<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class VerificadosModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios_verificados';

    protected $primaryKey = 'id_verificado';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'imagen',
    ];

    public static $reglas = [
        'nombre'=>'required',
        'apellido'=>'required',
        'email'=>'required|email:rfc',
        'password'=>'required',
    ];

    public static $mensajesDeError = [
        'nombre.required'=>'El nombre es obligatorio',
        'apellido.required'=>'El apellido es obligatorio',
        'email.required'=>'El email es obligatorio',
        'email.email'=>'El email debe ser de un formato válido (nombre@dominio.extension)',
        'password.required'=>'La contraseña es obligatoria',
    ];

    protected $hidden = [
        'remember_token',
    ];
}

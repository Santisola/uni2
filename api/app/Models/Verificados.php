<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @method static where(string $string, $usuario)
 */
class Verificados extends Model
{

    protected $table = 'usuarios_verificados';

    protected $primaryKey = 'id_verificado';

    protected $fillable = [
        'cuit',
        'razon_social',
        'telefono',
        'email',
        'password',
        'imagen',
    ];

    public static $reglas = [
        'cuit' => 'required|numeric|unique:usuarios_verificados,cuit',
//        'razon_social'=>'required',
        'email'=>'required|email:rfc|unique:usuarios_verificados,email',
        'password'=>'required',
    ];

    public static $mensajesDeError = [
        'cuit.required'=>'El Cuit es obligatorio',
        'cuit.unique'=>'Ya existe otro Cuit en nuestra base de datos',
        'cuit.numeric'=>'El Cuit deben ser sólo números',
//        'razon_social.required'=>'El nombre es obligatorio',
        'email.required'=>'El email es obligatorio',
        'email.email'=>'El email debe ser de un formato válido (nombre@dominio.extension)',
        'email.unique'=>'El email que intenta ingresar ya existe en nuestra base de datos',
        'password.required'=>'La contraseña es obligatoria',
    ];

    protected $hidden = [
        'password',
        'status'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}

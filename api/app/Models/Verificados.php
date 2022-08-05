<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static where(string $string, $usuario)
 */
class Verificados extends Model
{
    use SoftDeletes;

    protected $table = 'usuarios_verificados';

    protected $primaryKey = 'id_verificado';

    protected $fillable = [
        'cuit',
        'razon_social',
        'nombre',
        'telefono',
        'email',
        'password',
        'imagen',
        'status',
        'deleted_at',
    ];

    public static $reglas = [
        'cuit' => 'required|numeric|unique:usuarios_verificados,cuit',
        'email'=>'required|email:rfc|unique:usuarios_verificados,email',
        'password'=>'required',
    ];

    public static $mensajesDeError = [
        'cuit.required'=>'El CUIT es obligatorio',
        'cuit.unique'=>'Ya existe otro CUIT en nuestra base de datos',
        'cuit.numeric'=>'El CUIT deben ser sólo números',
        'email.required'=>'El email es obligatorio',
        'email.email'=>'El email debe ser de un formato válido (nombre@dominio.extension)',
        'email.unique'=>'El email que intenta ingresar ya existe en nuestra base de datos',
        'password.required'=>'La contraseña es obligatoria',
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

    public function eventos()
    {
        return $this->belongsTo(Eventos::class, 'id_evento', 'id_evento');
    }
}

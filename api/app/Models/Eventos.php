<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';

    protected $fillable = [
        'nombre',
        'descripcion',
        'desde',
        'hasta',
        'imagen',
        'publicado'
    ];

    public static $reglas = [
        'nombre'=>'required',
        'descripcion'=>'required',
        'desde'=>'required',
        'hasta'=>'required',
    ];

    public static $mensajesDeError = [
        'nombre.required'=>'El nombre del evento es obligatorio',
        'descripcion.required'=>'La descripción del evento es obligatoria',
        'desde.required'=>'Esta fecha es obligatoria',
        'hasta.required'=>'Esta fecha es obligatoria',
    ];
}

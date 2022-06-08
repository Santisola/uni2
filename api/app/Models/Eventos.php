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
        'latitud',
        'longitud',
        'desde',
        'hasta',
        'imagen',
        'publicado',
        'id_verificado',
        'status',
    ];

    public static $reglas = [
        'nombre'=>'required|min:3',
        'descripcion'=>'required|min:30',
        'latitud' => 'required|numeric',
        'longitud' => 'required|numeric',
        'desde'=>'required|date',
        'hasta'=>'required|date',
        'id_verificado' => 'numeric',
        'status' => 'boolean',
    ];

    public static $mensajesDeError = [
        'nombre.required'=>'El nombre del evento es obligatorio',
        'descripcion.required'=>'La descripción del evento es obligatoria',
        'latitud.required' => 'Debe seleccionar una ubicación',
        'longitud.required' => 'Debe seleccionar una ubicación',
        'desde.required'=>'Esta fecha es obligatoria',
        'hasta.required'=>'Esta fecha es obligatoria',
        'nombre.min' => 'El nombre del evento debe tener al menos 3 caracteres',
        'descripcion.min' => 'La descripción del evento debe tener al menos 30 caracteres',
        'latitud.numeric' => 'Hubo un error al seleccionar su ubicación',
        'longitud.numeric' => 'Hubo un error al seleccionar su ubicación',
        'desde.date' => 'Debe seleccionar una fecha y hora válida',
        'hasta.date' => 'Debe seleccionar una fecha y hora válida',
        'status.boolean' => 'Error en el el status'
    ];

    public function verificado()
    {
        $this->belongsTo(Verificados::class, 'id_verificado','id_verificado');
    }
}

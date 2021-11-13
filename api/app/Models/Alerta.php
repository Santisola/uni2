<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';

    protected $primaryKey = 'id_alerta';

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha',
        'hora',
        'imagenes',
        'latitud',
        'longitud',
        'id_usuario',
        'id_especie',
        'id_raza',
        'id_sexo',
        'id_tipoalerta',
    ];

    public static $reglas = [
        'nombre'=>'required',
        'descripcion'=>'required',
        'fecha'=>'required',
        'hora'=>'required',
        'latitud'=>'required',
        'longitud'=>'required',
        'id_usuario'=>'required',
        'id_especie'=>'required',
        'id_raza'=>'required',
        'id_sexo'=>'required',
        'id_tipoalerta'=>'required',
    ];

    public static $mensajesDeError = [
        'nombre.required'=>'El nombre es obligatorio',
        'descripcion.required'=>'La descripcion es obligatoria',
        'fecha.required'=>'La fecha es obligatoria',
        'hora.required'=>'La hora es obligatoria',
        'latitud.required'=>'La latitud es obligatoria',
        'longitud.required'=>'La longitud es obligatoria',
        'id_especie.required'=>'La especie es obligatoria',
        'id_raza.required'=>'La raza es obligatoria',
        'id_sexo.required'=>'El sexo es obligatorio',
    ];

    public function especie(){
        return $this->belongsTo(Especie::class,'id_especie', 'id_especie');
    }

    public function raza(){
        return $this->belongsTo(Raza::class,'id_raza', 'id_raza');
    }

    public function sexo(){
        return $this->belongsTo(Sexo::class,'id_sexo', 'id_sexo');
    }

    public function tipoalerta(){
        return $this->belongsTo(Tipoalerta::class,'id_tipoalerta', 'id_tipoalerta');
    }
}

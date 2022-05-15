<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticiasModel extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'titulo',
        'contenido',
        'slug',
        'imagen',
        'publicado'
    ];

    public static $reglas = [
        'titulo'=>'required',
        'contenido'=>'required',
        'slug'=>'required|unique',
        'imagen'=>'required',
    ];

    public static $mensajesDeError = [
        'titulo.required'=>'El titulo de la noticia es obligatorio',
        'contenido.required'=>'El contenido de la noticia es obligatorio',
        'slug.required'=>'El slug es obligatorio',
        'slug.unique'=>'El slug debe ser único e irrepetible, quizas ya exista otro slug con este nombre',
        'imagen.required'=>'La imagen es obligatoria',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id_noticia';

    protected $fillable = [
        'titulo',
        'contenido',
        'slug',
        'imagen',
        'publicado',
        'created_at',
        'updated_at'
    ];

    public static $reglas = [
        'titulo'=>'required|min:3',
        'contenido'=>'required|min:20',
        'slug'=>'required|unique:noticias',
        'imagen'=>'required|mimes:jpeg,jpg,png|max:10000',
    ];

    public static $reglasEdit = [
        'titulo'=>'required|min:3',
        'contenido'=>'required|min:20',
        'slug'=>'required',
        'imagen'=>'required|mimes:jpeg,jpg,png|max:10000',
    ];

    public static $mensajesDeError = [
        'titulo.required'=>'El titulo de la noticia es obligatorio',
        'contenido.required'=>'El contenido de la noticia es obligatorio',
        'slug.required'=>'El slug es obligatorio',
        'slug.unique'=>'El slug debe ser único e irrepetible, quizas ya exista otro slug con este nombre',
        'imagen.required'=>'La imagen es obligatoria',
        'imagen.mimes'=>'La imagen debe ser formato jpeg,jpg o png',
        'imagen.max' => 'La imagen es muy pesada intente subir otra',
    ];
}

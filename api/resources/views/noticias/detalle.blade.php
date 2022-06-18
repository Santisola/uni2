<?php
/**@var \App\Models\Noticias $noticia*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Noticias')
@section('main')
    <div class="container">
        <h1 class="text-center">{{ $noticia->titulo }}</h1>
        <div class="text-center">
            <img class="img-thumbnail" src="{{ asset('imgs/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }} imagen">
        </div>
        <h2 class="mt-3 h5">Contenido:</h2>
        <p class="mt-3">{{ $noticia->contenido }}</p>
        <ul class="mt-3">
            <li>Status: {{ $noticia->publicado === 1 ? 'Publicado' : 'Borrador' }}</li>
            <li>Fecha de creación: {{ date('d/m/Y H:i:s', strtotime($noticia->created_at)) }}</li>
            <li>Última modificación: {{ date('d/m/Y H:i:s', strtotime($noticia->updated_at)) }}</li>
        </ul>
        <a href="{{ route('noticias.editarForm', ['noticia' => $noticia->id_noticia]) }}" class="btn btn-warning my-3">Editar</a>
    </div>
@endsection

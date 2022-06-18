<?php
/**@var \App\Models\Noticias $noticia*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Noticias')
@section('main')
    <div class="container-2xl mb-5">
        <h1 class="text-center text-violet-800 font-bold text-3xl mb-5">{{ $noticia->titulo }}</h1>
        <div class="text-center w-full">
            <img class="max-w-4xl mx-auto w-full" src="{{ asset('imgs/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }} imagen">
        </div>
        <ul class="mt-5">
            @if($noticia->publicado === 1)
            <li class="rounded border border-double w-fit border-4 border-violet-800 px-3 px-2 bg-violet-800 text-white">Status: Publicado</li>
            @else
                <li class="rounded border border-2 w-fit border-violet-800 px-3 px-2 text-violet-800">Status: Borrador</li>
            @endif
            <li class="mt-3 text-sm text-zinc-500">Fecha de creación: {{ date('d/m/Y H:i:s', strtotime($noticia->created_at)) }}</li>
            <li class="text-sm text-zinc-500">Última modificación: {{ date('d/m/Y H:i:s', strtotime($noticia->updated_at)) }}</li>
        </ul>
        <h2 class="mt-5 text-2xl font-bold text-violet-800">Nota:</h2>
        <p class="mt-2 whitespace-pre-line mb-10">{{ $noticia->contenido }}</p>
        <a href="{{ route('noticias.editarForm', ['noticia' => $noticia->id_noticia]) }}" class="block border rounded bg-yellow-500 mt-5 hover:bg-yellow-600 transition hover:ease-in-out duration-300 px-5 py-1 w-fit">Editar</a>
    </div>
@endsection

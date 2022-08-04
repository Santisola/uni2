<?php
/**@var \App\Models\Noticias $noticia*/
/**@var \App\Models\Comentarios $comentarios*/
?>
@extends('layouts.main')
@section('title','Unidos | Detalle Noticia')
@section('main')
    <div id="noticia" class="container-2xl mb-5">
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
        <p class="mt-2 whitespace-pre-line mb-10 break-words detalle">{{ $noticia->contenido }}</p>
        <a href="{{ route('noticias.editarForm', ['noticia' => $noticia->id_noticia]) }}" class="w-full py-3 px-2 my-3 rounded border border-violet-800 text-center text-violet-800 hover:ease-in-out hover:text-white hover:bg-violet-800 transition duration-300 md:w-fit">Editar</a>
        <section id="comentarios">
            <h2 class="text-center text-violet-800 font-bold text-3xl mb-1 mt-5">Comentarios</h2>
            @forelse($comentarios as $comentario)
                <div class="comentario-container">
                    <dl class="flex items-center">
                        <div class="img-perfil">
                            @if($comentario->verificado->imagen)
                                <img src="" alt="Imagen del verificado">
                            @else
                                <img src="{{ asset('imgs/user-default.png') }}" alt="imagen default">
                            @endif
                        </div>
                        <div class="flex pl-4 items-center">
                            <dt class="sr-only">Razón Social:</dt>
                            <dd class="font-semibold">{{ $comentario->verificado->razon_social }}</dd>
                            <dt class="sr-only">Estatus</dt>
                            @if($comentario->verificado->status === 1)
                                <dd class="pl-1">
                                    <img width="15" height="15" src="{{ asset('imgs/verificado.svg') }}" alt="verificado">
                                </dd>
                            @else
                                <dd class="sr-only">No verificado</dd>
                            @endif
                        </div>
                    </dl>
                    <p class="comentario">{{ $comentario->comentario }}</p>
                </div>
            @empty
                <h3 class="text-center my-10">No hay comentarios</h3>
            @endforelse
        </section>
    </div>
@endsection

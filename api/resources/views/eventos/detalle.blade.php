<?php
/**@var \App\Models\Noticias $evento*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Detalle Evento')
@section('main')
    <div class="container-2xl mb-5">
        <h1 class="text-center text-violet-800 font-bold text-3xl mb-5">{{ $evento->titulo }}</h1>
        <div class="text-center w-full">
            <img class="max-w-4xl mx-auto w-full" src="{{ asset(str_replace('public/','',$evento->imagen)) }}" alt="{{ $evento->nombre }} imagen">
        </div>
        <ul class="mt-5">
            {{--@if($evento->publicado === 1)
            <li class="rounded border border-double w-fit border-4 border-violet-800 px-3 px-2 bg-violet-800 text-white">Status: Publicado</li>
            @else
                <li class="rounded border border-2 w-fit border-violet-800 px-3 px-2 text-violet-800">Status: Borrador</li>
            @endif--}}
            <li class="mt-3 text-sm text-zinc-500">Dirección: {{ $evento->direccion }}</li>
            <li class="mt-3 text-sm text-zinc-500">Fecha de creación: {{ date('d/m/Y H:i:s', strtotime($evento->created_at)) }}</li>
            <li class="text-sm text-zinc-500">Última modificación: {{ date('d/m/Y H:i:s', strtotime($evento->updated_at)) }}</li>
        </ul>
        <h2 class="mt-5 text-2xl font-bold text-violet-800">Nota:</h2>
        <p class="mt-2 whitespace-pre-line mb-10 break-words detalle">{{ $evento->descripcion }}</p>
        <!-- TODO: "eliminar" evento -->
    </div>
@endsection

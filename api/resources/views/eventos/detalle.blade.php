<?php
/**@var \App\Models\Eventos $evento*/
?>
@extends('layouts.main')
@section('title','Unidos | Detalle Evento')
@section('main')
    <div id="evento" class="container-2xl mb-5">
        <h1 class="text-center text-violet-800 font-bold text-3xl mb-5">{{ $evento->titulo }}</h1>
        <div class="flex flex-wrap">
            <div class="text-center md:w-1/2 w-full">
                <img class="max-w-4xl mx-auto w-full" src="{{ asset(str_replace('public/','',$evento->imagen)) }}" alt="{{ $evento->nombre }} imagen">
            </div>
            <div class="text-center md:w-1/2 w-full px-10 flex flex-col justify-between">
                <div>
                    <h2 class="mt-5 text-2xl font-bold text-violet-800 mb-10">{{ $evento->nombre }}</h2>
                    <p class="mt-2 whitespace-pre-line mb-10 break-words detalle md:text-start">{{ $evento->descripcion }}</p>
                    <ul class="mt-10">
                        <li class="text-sm text-zinc-500">Dirección: {{ $evento->direccion }}</li>
                        <li class="mt-2 text-sm text-zinc-500">Fecha de creación: {{ date('d/m/Y H:i:s', strtotime($evento->created_at)) }}hs</li>
                        <li class="mt-2 text-sm text-zinc-500">Última modificación: {{ date('d/m/Y H:i:s', strtotime($evento->updated_at)) }}hs</li>
                    </ul>
                    <iframe class="iframe-google" src="https://maps.google.com/maps?q={{$evento->latitud}},{{$evento->longitud}}&z=14&output=embed" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        @if($evento->deleted_at)
            <form action="{{ route('eventos.restaurar', ['evento' => $evento->id_evento]) }}">
                @csrf
                <button type="submit" class="w-full px-3 py-3 px-2 rounded text-center bg-green-600 hover:bg-green-700 hover:ease-in-out transition duration-300 text-white mt-5">Restaurar</button>
            </form>
        @else
            <form action="{{ route('eventos.eliminar', ['evento' => $evento->id_evento]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded mt-5 text-center py-3 px-2 block w-full text-red-800 hover:text-white hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar">Eliminar</button>
            </form>
        @endif
    </div>
@endsection

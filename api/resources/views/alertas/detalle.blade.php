<?php
/**@var \App\Models\Alerta $alerta*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Detalle Alerta')
@section('main')
    <div class="container-2xl mb-5 detalle-alerta-container">
        <div class="text-center w-full">
            <iframe src="https://maps.google.com/maps?q={{ $alerta->latitud }},{{ $alerta->longitud }}&z=15&output=embed" width="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div>
            @if($alerta->nombre)
            <h2 class="mt-2 whitespace-pre-line mb-10 break-words titulo">{{ $alerta->nombre }}</h2>
            @else
            <h2 class="sr-only">Detalle de la alerta</h2>
            @endif

            <p class="mt-2 whitespace-pre-line mb-10 break-words detalle">{{ $alerta->descripcion }}</p>
            <ul class="mt-5">
                {{-- <li class="mt-3 text-sm text-zinc-500">Dirección: {{ $alerta->direccion }}</li> --}}
                <li class="mt-3 text-sm text-zinc-500">Fecha: {{ explode('-', $alerta->fecha)[2] }}-{{ explode('-', $alerta->fecha)[1] }}-{{ explode('-', $alerta->fecha)[0] }}, a las {{ $alerta->hora }}hs</li>
                <li class="mt-3 text-sm text-zinc-500">Especie: {{$alerta->especie->especie}}</li>
                <li class="mt-3 text-sm text-zinc-500">Raza: {{$alerta->raza->raza ?? 'Desconocida'}}</li>
                <li class="mt-3 text-sm text-zinc-500">Sexo: {{$alerta->sexo->sexo ?? 'Desconocido'}}</li>
            </ul>

            <ul class="detalle-alerta-imgs">
                @foreach ($alerta->imagenes as $img)
                <li>
                    <img class="max-w-4xl mx-auto w-full" src="{{ asset('imgs/mascotas/' . $img) }}" alt="{{ $alerta->nombre ?? 'Imagen de la mascota' }}">
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

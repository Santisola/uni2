<?php
/**@var $alertas*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Alertas')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Alertas</h1>
    @forelse($alertas as $alerta)
        <div class="flex flex-col md:flex-row flex-wrap justify-between items-center w-full py-5 px-10 mb-5 tableta shadow-lg rounded-lg {{ $alerta->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }} tableta-alertas">
            <div>
                @if($alerta->imagenes)
                    <img class="img-evento border rounded border-2 border-{{ $alerta->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}" src="{{ asset('imgs/mascotas/' . strtok($alerta->imagenes, '|')) }}" alt="Imagen mascota perdida">
                @else
                    <img class="img-evento border rounded-full border-2 border-{{ $alerta->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                @endif
            </div>
            <dl>
                <dt class="sr-only">Nombre:</dt>
                <dd class="text-center font-semibold mb-5">{{ $alerta->nombre ?? '-' }}</dd>
                <dt class="sr-only">Descripción</dt>
                <dd>
                    {{$alerta->descripcion}}
                </dd>
            </dl>
            <dl>
                <div class="flex gap-3 mb-3">
                    <dt class="font-semibold">Fecha:</dt>
                    <dd>{{ explode('-', $alerta->fecha)[2] }}-{{ explode('-', $alerta->fecha)[1] }}-{{ explode('-', $alerta->fecha)[0] }}, a las {{ $alerta->hora }}hs</dd>
                </div>
                <div class="flex gap-3 mb-3">
                    <dt class="font-semibold">Especie:</dt>
                    <dd>{{ $alerta->especie->especie }}</dd>
                </div>
                <div class="flex gap-3 mb-3">
                    <dt class="font-semibold">Raza:</dt>
                    <dd>{{ $alerta->raza->raza }}</dd>
                </div>
                <div class="flex gap-3 mb-3">
                    <dt class="font-semibold">Sexo:</dt>
                    <dd>{{ $alerta->sexo->sexo }}</dd>
                </div>
            </dl>
        </div>
    @empty
        <div class="flex justify-center items-center w-full px-5 mb-5">
            <h2 class="text-center text-3xl">No hay Datos</h2>
        </div>
    @endforelse
    <div class="flex justify-start items-center py-3 mt-5">
        {{ $alertas->links() }}
    </div>
@endsection

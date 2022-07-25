<?php
/**
 * @var $results
 */
?>
@extends('layouts.main')
@section('title','UNIDOS | Inicio')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">ÚLTIMAS ACTUALIZACIONES</h1>
    @if(count($results) > 0)
        <div id="tarjetas">
            @foreach($results as $result)
                @if($result->id_evento)
                    <div class="flex flex-col justify-start items-center w-full py-5 px-10 mb-5 card eventos shadow-lg rounded-lg">
                        <div>
                            <img class="img-evento border block w-full max-w-sm rounded-full border-2 border-yellow-500" src="{{ asset(str_replace('public/','',$result->imagen)) }}" alt="imagen del evento">
                        </div>
                        <dl>
                            <dt class="sr-only">Título del evento:</dt>
                            <dd class="font-semibold mb-5 mt-5 md:mt-0">{{ $result->nombre }}</dd>
                            <dt class="sr-only">Descripción del evento:</dt>
                            <dd class="detalle">{{ substr($result->descripcion, 0, 40 ) }}</dd>
                        </dl>
                    </div>
                @elseif($result->id_verificado)
                    <div class="flex flex-col justify-start items-center w-full py-5 px-10 mb-5 card verificados shadow-lg rounded-lg">
                        <div>
                            @if($result->imagen)
                                <img class="img-perfil border rounded border-2 border-violet-800" src="{{ asset(str_replace('public/','',$result->imagen)) }}" alt="Imagen usuario">
                            @else
                                <img class="img-perfil border rounded-full border-2 border-violet-800" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                            @endif
                        </div>
                        <dl class="mt-5">
                            <dt class="sr-only">Cuit:</dt>
                            <dd class="mb-5">{{ $result->cuit }}</dd>
                            <dt class="sr-only">Razón social:</dt>
                            <dd class="mb-5">{{ $result->razon_social }}</dd>
                            <dt class="font-semibold">Nombre visible:</dt>
                            <dd>{{ $result->nombre ?? '-' }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold">Contacto:</dt>
                            <dd class="underline underline-offset-8 hover:underline-offset-4">{{ $result->email }}</dd>
                            <dd>{{ $result->telefono ?? '-' }}</dd>
                        </dl>
                    </div>
                @elseif($result->id_alerta)
                    <div class="flex flex-col justify-start items-center w-full py-5 px-10 mb-5 card shadow-lg rounded-lg {{ $result->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}">
                        <div>
                            @if($result->imagenes)
                                <img class="img-evento border rounded border-2 border-{{ $result->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}" src="{{ asset('imgs/mascotas/' . strtok($result->imagenes, '|')) }}" alt="Imagen mascota perdida">
                            @else
                                <img class="img-evento border rounded-full border-2 border-{{ $result->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                            @endif
                        </div>
                        <dl class="mt-5">
                            <dt class="sr-only">Nombre:</dt>
                            <dd class="mb-3">{{ $result->nombre ?? '-' }}</dd>
                        </dl>
                        <dl class="mt-3 w-full">
                            <div class="flex gap-3 mb-3">
                                <dt>Hora:</dt>
                                <dd>{{ $result->hora }}</dd>
                            </div>
                            <div class="flex gap-3 mb-3">
                                <dt>Especie:</dt>
                                <dd>{{ $result->especie->especie }}</dd>
                            </div>
                            <div class="flex gap-3 mb-3">
                                <dt>Raza:</dt>
                                <dd>{{ $result->raza->raza }}</dd>
                            </div>
                            <div class="flex gap-3 mb-3">
                                <dt>Sexo:</dt>
                                <dd>{{ $result->sexo->sexo }}</dd>
                            </div>
                        </dl>
                    </div>
                @elseif($result->id_usuario)
                    <div class="flex flex-col justify-start items-center w-full py-5 px-10 mb-5 card shadow-lg rounded-lg usuarios">
                        <div>
                            @if($result->imagen)
                                <img class="img-perfil border rounded border-2 border-violet-800" src="{{ asset(str_replace('public/','',$result->imagen)) }}" alt="Imagen usuario">
                            @else
                                <img class="img-perfil border rounded-full border-2 border-violet-800" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                            @endif
                        </div>
                        <dl class="mt-5">
                            <dt class="sr-only">Nombre:</dt>
                            <dd class="mb-3">{{ $result->nombre ?? '-' }}</dd>
                        </dl>
                        <dl class="mt-3 w-full">
                            <div class="flex gap-3 mb-3">
                                <dt>Email:</dt>
                                <dd class="detalle">{{ $result->email }}</dd>
                            </div>
                            <div class="flex gap-3 mb-3">
                                <dt>Telefono:</dt>
                                <dd>{{ $result->telefono }}</dd>
                            </div>
                        </dl>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <h2 class="text-3xl text-center">No hay resultados</h2>
    @endif
@endsection

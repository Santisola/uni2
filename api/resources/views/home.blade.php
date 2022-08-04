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
                    <div class="tarjeta evento">
                        <div class="container-img">
                            <img src="{{ asset(str_replace('public/','',$result->imagen)) }}" alt="{{ $result->nombre }}">
                        </div>
                        <h2 class="tipo">Evento</h2>
                        <h3>{{ $result->nombre }}</h3>
                        <ul>
                            <li>Desde: <span>{{ date('d/m/Y H:i:s', strtotime($result->desde)) }}hs</span></li>
                            <li>Hasta: <span>{{ date('d/m/Y H:i:s', strtotime($result->hasta)) }}hs</span></li>
                        </ul>
                        <p>Creado por {{ $result->verificado->razon_social }}</p>
                    </div>
                @elseif($result->id_verificado)
                    <div class="tarjeta verificados">
                        <div class="container-img">
                            <img src="{{ $result->imagen ? asset(str_replace('public/','', $result->imagen)) : asset('imgs/user-default.png') }}" alt="{{ $result->razon_social }}">
                        </div>
                        <h2 class="tipo">Verificado</h2>
                        <h3>{{ $result->razon_social }}</h3>
                        <ul>
                            <li>Email: <span>{{ $result->email }}</span></li>
                            <li>Tel.: <span>{{ $result->telefono }}</span></li>
                            <li>Cuit: <span>{{ $result->cuit }}</span></li>
                        </ul>
                    </div>
                @elseif($result->id_alerta)
                    <div class="tarjeta {{ $result->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}">
                        <div class="container-img">
                            @if($result->imagenes)
                                <img src="{{ asset('imgs/mascotas/' . $result->imagenes[0]) }}" alt="Imagen mascota perdida">
                            @else
                                <img src="{{ asset('imgs/icono-mascota-default.jpg') }}" alt="Default mascota">
                            @endif
                        </div>
                        <h2 class="tipo">{{ $result->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}</h2>
                        <h3>{{ $result->nombre ?? '-' }}</h3>
                        <ul>
                            <li>Fecha: <span>{{ date('d/m/Y', strtotime($result->fecha)) }} {{ date('H:i:s', strtotime($result->hora)) }}hs</span></li>
                            <li>Raza.: <span>{{ $result->raza->raza }}</span></li>
                            <li>Sexo: <span>{{ $result->sexo->sexo }}</span></li>
                        </ul>
                        <p>Creado por {{ $result->usuario->nombre }}</p>
                    </div>
                @elseif($result->id_usuario)
                    <div class="tarjeta verificados">
                        <div class="container-img">
                            @if($result->imagen)
                                <img src="{{ asset(str_replace('public/','',$result->imagen)) }}" alt="Imagen usuario">
                            @else
                                <img src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                            @endif
                        </div>
                        <h2 class="tipo">Usuario</h2>
                        <h3>{{ $result->nombre }}</h3>
                        <ul>
                            <li>Email: <span>{{ $result->email }}</span></li>
                            <li>Tel.: <span>{{ $result->telefono }}</span></li>
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <h2 class="text-3xl text-center">No hay resultados</h2>
    @endif
@endsection

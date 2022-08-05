<?php
/**@var $alertas*/
?>
@extends('layouts.main')
@section('title','Unidos | Alertas')
@section('main')
    <h1 class="text-center text-3xl mb-10 texto-violeta font-bold">Alertas</h1>
    <div id="tarjetas">
        @forelse($alertas as $alerta)
            <div class="tarjeta {{ $alerta->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}">
                <div class="w-full">
                    <div class="container-img">
                        @if($alerta->imagenes)
                            <img src="{{ asset('imgs/mascotas/' . $alerta->imagenes[0]) }}" alt="Imagen mascota perdida">
                        @else
                            <img src="{{ asset('imgs/icono-mascota-default.jpg') }}" alt="Default mascota">
                        @endif
                    </div>
                    <h2 class="tipo">{{ $alerta->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}</h2>
                    <h3>{{ $alerta->nombre ?? $alerta->especie->especie }}</h3>
                    <ul>
                        <li>Fecha: <span>{{ date('d/m/Y', strtotime($alerta->fecha)) }} {{ date('H:i:s', strtotime($alerta->hora)) }}hs</span></li>
                        <li>Raza.: <span>{{ $alerta->raza->raza }}</span></li>
                        <li>Sexo: <span>{{ $alerta->sexo->sexo }}</span></li>
                    </ul>
                    <p>Creado por {{ $alerta->usuario->nombre }}</p>
                </div>
                <div class="actions w-full">
                    <a class="block w-full py-3 px-2 my-3 rounded border-violet-800 text-center bg-violeta hover:bg-indigo-700 text-white transition ease-in-out" href="{{ route('alertas.detalle', ['alerta' => $alerta->id_alerta]) }}">Detalle</a>
                    @if($alerta->deleted_at)
                        <form action="{{ route('alertas.restaurar', ['alerta' => $alerta->id_alerta]) }}">
                            @csrf
                            <button type="submit" class="w-full px-3 py-3 px-2 my-3 rounded text-center bg-green-600 hover:bg-green-700 hover:ease-in-out transition duration-300 text-white">Restaurar</button>
                        </form>
                    @else
                        <form action="{{ route('alertas.eliminar', ['alerta' => $alerta->id_alerta]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded mt-5 text-center py-3 px-2 block w-full text-red-800 hover:text-white hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="flex justify-center items-center w-full px-5 mb-5">
                <h2 class="text-center text-3xl">No hay Datos</h2>
            </div>
        @endforelse
    </div>
@endsection

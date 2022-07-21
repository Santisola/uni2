<?php
/**@var $alertas*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Alertas')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Eventos</h1>
    @forelse($alertas as $alerta)
        <div class="flex flex-col md:flex-row flex-wrap justify-between items-center w-full py-5 px-10 mb-5 tableta shadow-lg rounded-lg {{ $alerta->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}">
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
                    @if(strlen($alerta->descripcion) > 20)
                        {{ substr(ucfirst($alerta->descripcion), 20) }}[...]
                    @else
                        {{ ucfirst($alerta->descripcion) }}
                    @endif
                </dd>
            </dl>
            <dl>
                <div class="flex gap-3 mb-3">
                    <dt class="font-semibold">Horario {{ $alerta->tipoalerta->id_tipoalerta === 1 ? 'perdida' : 'encontrada' }}:</dt>
                    <dd>{{ $alerta->hora }}hs</dd>
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
            {{--<div class="flex flex-col">
                <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-yellow-500 hover:bg-yellow-600 transition hover:ease-in-out duration-300 md:w-fit w-full" href="{{ route('eventos.detalle', ['evento' => $alerta->id_evento]) }}">Detalle</a>
                @if($alerta->deleted_at)
                    <form action="{{ route('eventos.restaurar', ['evento' => $alerta->id_verificado]) }}">
                        @csrf
                        <button type="submit" class="w-full px-3 py-3 px-2 my-3 rounded text-center bg-green-600 hover:bg-green-700 hover:ease-in-out transition duration-300 text-white">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('eventos.eliminar', ['evento' => $alerta->id_evento]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded text-center py-3 px-2 my-3 block w-full bg-red-500 hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar">Eliminar</button>
                    </form>
                @endif
            </div>--}}
        </div>
    @empty
        <div class="flex justify-center items-center w-full px-5 mb-5">
            <h2 class="text-center text-3xl">No hay Datos</h2>
        </div>
    @endforelse
@endsection
{{--@push('js')
    <script src="{{ asset('js/selector.js') }}"></script>
@endpush--}}

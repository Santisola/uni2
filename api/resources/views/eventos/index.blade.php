<?php
/**@var $eventos*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Eventos')
@section('main')
    <div class="container">
        <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Eventos</h1>
        @forelse($eventos as $evento)
            <div class="flex flex-wrap justify-between items-center w-full py-5 px-10 mb-5 tableta eventos shadow-lg rounded-lg">
                <div>
                    <img class="img-evento border block w-full max-w-sm rounded-full border-2 border-yellow-500" src="{{ asset(str_replace('public/','',$evento->imagen)) }}" alt="imagen del evento">
                </div>
                <dl>
                   <dt class="sr-only">Título del evento:</dt>
                    <dd class="font-semibold mb-5">{{ $evento->nombre }}</dd>
                    <dt class="sr-only">Descripción del evento:</dt>
                    <dd>{{ substr($evento->descripcion, 0, 40 ) }}</dd>
                </dl>
                <dl>
                    <dt class="sr-only">Status:</dt>
                    @if($evento->publicado === 1)
                        <dd class="text-violet-800 font-semibold">Publicado</dd>
                    @else
                        <dd class="text-violet-800 font-semibold">Borrador</dd>
                    @endif
                </dl>
                <dl>
                    <div class="mb-5">
                        <dt class="text-sm text-zinc-500">Fecha de creación:</dt>
                        <dd class="text-sm text-zinc-500">{{ date('d/m/Y H:i:s', strtotime($evento->created_at)) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-zinc-500">Última modificación:</dt>
                        <dd class="text-sm text-zinc-500">{{ date('d/m/Y H:i:s', strtotime($evento->updated_at)) }}</dd>
                    </div>
                </dl>
                <div class="flex flex-col">
                    <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-yellow-500 hover:bg-yellow-600 transition hover:ease-in-out duration-300" href="{{ route('eventos.detalle', ['evento' => $evento->id_evento]) }}">Detalle</a>
                    {{--<a href="{{ route('eventos.eliminar', ['evento' => $evento->id_evento]) }}" class="rounded text-center py-3 px-2 my-3 block w-full bg-red-500 hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar">Eliminar</a>--}}
                </div>
            </div>
        @empty
            <div class="flex justify-center items-center w-full px-5 mb-5">
                <h2 class="text-center text-3xl">No hay Datos</h2>
            </div>
        @endforelse
    </div>
@endsection

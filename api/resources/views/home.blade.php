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
                    <div class="flex flex-col justify-center items-center w-full py-5 px-10 mb-5 card eventos shadow-lg rounded-lg">
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
                    <div class="flex flex-col justify-center items-center w-full py-5 px-10 mb-5 card verificados shadow-lg rounded-lg">
                        <div>
                            @if($result->imagen)
                                <img class="img-perfil border rounded border-2 border-violet-800" src="{{ asset(str_replace('public/','',$result->imagen)) }}" alt="Imagen usuario">
                            @else
                                <img class="img-perfil border rounded-full border-2 border-violet-800" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                            @endif
                        </div>
                        <dl>
                            <dt class="sr-only">Cuit:</dt>
                            <dd class="mb-5">{{ $result->cuit }}</dd>
                            <dt class="sr-only">Razón social:</dt>
                            <dd class="mb-5">{{ $result->razon_social }}</dd>
                        </dl>
                        <dl>
                            <dt class="font-semibold">Contacto:</dt>
                            <dd class="underline underline-offset-8 hover:underline-offset-4">{{ $result->email }}</dd>
                            <dd>{{ $result->telefono ?? '-' }}</dd>
                        </dl>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <h2 class="text-3xl text-center">No hay resultados</h2>
    @endif
@endsection

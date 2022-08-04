<?php
/**@var $contactos*/
?>
@extends('layouts.main')
@section('title','Unidos | Eventos')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Contactos</h1>
    <div id="tarjetas">
        @forelse($contactos as $contacto)
            <div class="tarjeta contactos">
                <div class="container-img">
                    <img src="{{ $contacto->verificado->imagen ? asset(str_replace('public/','', $contacto->verificado->imagen)) : asset('imgs/user-default.png') }}" alt="{{ $contacto->verificado->razon_social }}">
                </div>
                <h2 class="tipo">Contacto</h2>
                <h3>{{ $contacto->asunto }}</h3>
                <ul>
                    <li>Email: <span>{{ $contacto->verificado->email }}</span></li>
                    <li>Tel.: <span>{{ $contacto->verificado->telefono ?? '-' }}</span></li>
                    <li>Cuit: <span>{{ $contacto->verificado->cuit }}</span></li>
                </ul>
                <div class="flex flex-col w-full">
                    <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-yellow-500 hover:bg-yellow-600 transition hover:ease-in-out duration-300" href="{{ route('contacto.detalle', ['contacto' => $contacto->id_contacto]) }}">Detalle</a>
                </div>
            </div>
        @empty
            <div class="flex justify-center items-center w-full px-5 mb-5">
                <h2 class="text-center text-3xl">No hay mensajes</h2>
            </div>
        @endforelse
    </div>
    <div class="flex justify-start items-center py-3 mt-5">
        {{ $contactos->links() }}
    </div>
@endsection

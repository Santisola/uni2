<?php
/**@var \App\Models\Contacto $contacto*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Detalle Contacto')
@section('main')
    <div class="container-2xl mb-5 ">
        <h1 class="text-center text-violet-800 font-bold text-3xl mb-5 capitalize">Asunto: {{ $contacto->asunto }}</h1>
        <div class="mx-auto rounded border max-w-4xl p-5">
            <div class="flex justify-center items-center w-full">
                @if($contacto->verificado->imagen)
                    <img class="img-perfil border rounded border-2 border-violet-800" src="{{ asset(str_replace('public/','',$contacto->verificado->imagen)) }}" alt="Imagen usuario">
                @else
                    <img class="img-perfil border rounded-full border-2 border-violet-800" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                @endif
            </div>
            <h2 class="mt-5 text-2xl font-bold text-violet-800">Mensaje:</h2>
            <p class="mt-2 whitespace-pre-line mb-10 break-words detalle border bg-gray-100 round p-5">{{ $contacto->mensaje }}</p>
            <ul class="mt-5 flex justify-between items-center">
                <li class="mt-3 text-sm text-zinc-500">Dirección: {{ $contacto->verificado->nombre ?? $contacto->verificado->razon_social }}</li>
                <li class="mt-3 text-sm text-zinc-500">Fecha de envío: {{ date('d/m/Y H:i:s', strtotime($contacto->created_at)) }}</li>
            </ul>
        </div>
    </div>
@endsection

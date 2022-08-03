<?php
/**@var $contactos*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Eventos')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Contactos</h1>
    @forelse($contactos as $contacto)
        <div class="flex flex-col md:flex-row flex-wrap justify-between items-center w-full py-5 px-10 mb-5 tableta verificados shadow-lg rounded-lg">
            <div>
                @if($contacto->verificado->imagen)
                    <img class="img-perfil border rounded border-2 border-violet-800" src="{{ asset(str_replace('public/','',$contacto->verificado->imagen)) }}" alt="Imagen usuario">
                @else
                    <img class="img-perfil border rounded-full border-2 border-violet-800" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                @endif
            </div>
            <dl>
                <div class="flex gap-3 items-center justify-start mb-5">
                    <dt class="font-semibold">Asunto:</dt>
                    <dd class="mt-5 md:mt-0 capitalize">{{ $contacto->asunto }}</dd>
                </div>
                <div class="flex gap-3 items-center justify-start">
                    <dt class="font-semibold">Mensaje:</dt>
                    <dd class="detalle">{{ substr($contacto->mensaje, 0, 40 ) }}</dd>
                </div>
            </dl>
            <dl>
                <div class="mb-5">
                    <dt class="text-sm text-zinc-500">Fecha de envío:</dt>
                    <dd class="text-sm text-zinc-500">{{ date('d/m/Y H:i:s', strtotime($contacto->created_at)) }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-zinc-500">Enviado por:</dt>
                    <dd class="text-sm text-zinc-500">{{ $contacto->verificado->nombre ?? $contacto->verificado->razon_social  }}</dd>
                </div>
            </dl>
            <div class="flex flex-col">
                <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-yellow-500 hover:bg-yellow-600 transition hover:ease-in-out duration-300 md:w-fit w-full" href="{{ route('contacto.detalle', ['contacto' => $contacto->id_contacto]) }}">Detalle</a>
            </div>
        </div>
    @empty
        <div class="flex justify-center items-center w-full px-5 mb-5">
            <h2 class="text-center text-3xl">No hay mensajes</h2>
        </div>
    @endforelse
    <div class="flex justify-start items-center py-3 mt-5">
        {{ $contactos->links() }}
    </div>
@endsection

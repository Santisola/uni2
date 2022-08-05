<?php
/**@var $eventos*/
?>
@extends('layouts.main')
@section('title','Unidos | Eventos')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Eventos</h1>
    <div class="flex justify-center md:justify-between items-center gap-3 flex-wrap">
        <form id="formulario" action="{{ route('eventos') }}" method="get" class="md:w-1/2 w-full mb-5 px-3 md:px-0">
            <div>
                <label for="eventos" class="sr-only">Seleccione</label>
                <select name="eventos" id="eventos" class="border border-violet-800 rounded w-full bg-white px-2 py-1">
                    <option value="" {{ $seleccionado === null ? 'selected' : '' }}>Todos</option>
                    <option value="eliminados" {{ $seleccionado === 'eliminados' ? 'selected' : '' }}>Bloqueados</option>
                    <option value="no-eliminados" {{ $seleccionado === 'desbloqueados' ? 'selected' : '' }}>Sin bloquear</option>
                </select>
            </div>
        </form>
    </div>
    <div id="tarjetas">
        @forelse($eventos as $evento)
            <div class="tarjeta evento">
                <div class="container-img">
                    <img src="{{ asset(str_replace('public/','',$evento->imagen)) }}" alt="{{ $evento->nombre }}">
                </div>
                <h2 class="tipo">Evento</h2>
                <h3>{{ $evento->nombre }}</h3>
                <ul>
                    <li>Desde: <span>{{ date('d/m/Y H:i:s', strtotime($evento->desde)) }}hs</span></li>
                    <li>Hasta: <span>{{ date('d/m/Y H:i:s', strtotime($evento->hasta)) }}hs</span></li>
                </ul>
                <p>Creado por {{ $evento->verificado->razon_social }}</p>
                <div class="h-full w-full flex flex-col justify-end items-center">
                    <a class="w-full py-3 px-2 my-3 rounded border border-violet-600 text-center text-violet-800 hover:ease-in-out hover:text-white hover:bg-violet-800 transition duration-300" href="{{ route('eventos.detalle', ['evento' => $evento->id_evento]) }}">Detalle</a>
                    @if($evento->deleted_at)
                        <form action="{{ route('eventos.restaurar', ['evento' => $evento->id_evento]) }}">
                            @csrf
                            <button type="submit" class="restaurar rounded text-center py-3 px-2 my-3 block hover:bg-green-600 transition hover:ease-in-out duration-300 hover:text-white text-green-600 w-full">Restaurar</button>
                        </form>
                    @else
                        <form action="{{ route('eventos.eliminar', ['evento' => $evento->id_evento]) }}" method="post" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded text-center py-3 px-2 my-3 block hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar hover:text-white text-red-600 w-full">Eliminar</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="flex flex-col">
                @empty
                    <div class="flex justify-center items-center w-full px-5 mb-5">
                        <h2 class="text-center text-3xl">No hay Datos</h2>
                    </div>
                @endforelse
    </div>
    <div class="flex justify-start items-center py-3 mt-5">
        {{ $eventos->links() }}
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/selector.js') }}"></script>
@endpush

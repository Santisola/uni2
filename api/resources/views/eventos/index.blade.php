<?php
/**@var $eventos*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Eventos')
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
    @forelse($eventos as $evento)
        <div class="flex flex-col md:flex-row flex-wrap justify-between items-center w-full py-5 px-10 mb-5 tableta eventos shadow-lg rounded-lg {{ $evento->deleted_at ? 'deleted' : '' }}">
            <div>
                <img class="img-evento border block w-full max-w-sm rounded-full border-2 border-yellow-500" src="{{ asset(str_replace('public/','',$evento->imagen)) }}" alt="imagen del evento">
            </div>
            <dl>
               <dt class="sr-only">Título del evento:</dt>
                <dd class="font-semibold mb-5 mt-5 md:mt-0">{{ $evento->nombre }}</dd>
                <dt class="sr-only">Descripción del evento:</dt>
                <dd class="detalle">{{ substr($evento->descripcion, 0, 40 ) }}</dd>
            </dl>
            <dl>
                <div class="mb-5">
                    <dt class="text-sm text-zinc-500">Fecha de creación:</dt>
                    <dd class="text-sm text-zinc-500">{{ date('d/m/Y H:i:s', strtotime($evento->created_at)) }}</dd>
                </div>
                <div class="mb-5">
                    <dt class="text-sm text-zinc-500">Última modificación:</dt>
                    <dd class="text-sm text-zinc-500">{{ date('d/m/Y H:i:s', strtotime($evento->updated_at)) }}</dd>
                </div>
                @if($evento->deleted_at)
                    <div class="mb-5">
                        <dt class="text-sm text-zinc-500">Fecha de eliminación:</dt>
                        <dd class="text-sm text-zinc-500">{{ date('d/m/Y H:i:s', strtotime($evento->deleted_at)) }}</dd>
                    </div>
                @endif
                <div>
                    <dt class="text-sm text-zinc-500">Creado por:</dt>
                    <dd class="text-sm text-zinc-500">{{ $evento->verificado->nombre ?? $evento->verificado->razon_social  }}</dd>
                </div>
            </dl>
            <div class="flex flex-col">
                <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-yellow-500 hover:bg-yellow-600 transition hover:ease-in-out duration-300 w-full" href="{{ route('eventos.detalle', ['evento' => $evento->id_evento]) }}">Detalle</a>
                @if($evento->deleted_at)
                    <form action="{{ route('eventos.restaurar', ['evento' => $evento->id_evento]) }}">
                        @csrf
                        <button type="submit" class="w-full px-3 py-3 px-2 my-3 rounded text-center bg-green-600 hover:bg-green-700 hover:ease-in-out transition duration-300 text-white w-full">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('eventos.eliminar', ['evento' => $evento->id_evento]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded text-center py-3 px-2 my-3 block w-full bg-red-500 hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar w-full">Eliminar</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="flex justify-center items-center w-full px-5 mb-5">
            <h2 class="text-center text-3xl">No hay Datos</h2>
        </div>
    @endforelse
    <div class="flex justify-start items-center py-3 mt-5">
        {{ $eventos->links() }}
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/selector.js') }}"></script>
@endpush

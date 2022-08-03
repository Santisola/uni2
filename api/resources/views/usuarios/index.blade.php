<?php
    /**@var \App\Models\Verificados $usuarios*/
    /**@var \App\Models\Admin $seleccionado*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Usuarios')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Usuarios</h1>
    <div class="flex justify-center md:justify-between items-center gap-3 flex-wrap">
        <form id="formulario" action="{{ route('usuarios') }}" method="get" class="md:w-1/2 w-full mb-5 px-3 md:px-0">
            <div>
                <label for="usuarios" class="sr-only">Seleccione</label>
                <select name="usuarios" id="usuarios" class="border border-violet-800 rounded w-full bg-white px-2 py-1">
                    <option value="" {{ $seleccionado === null ? 'selected' : '' }}>Todos</option>
                    <option value="eliminados" {{ $seleccionado === 'eliminados' ? 'selected' : '' }}>Bloqueados</option>
                </select>
            </div>
        </form>
    </div>
    @forelse($usuarios as $usuario)
        <div class="flex flex-wrap justify-between items-center w-full py-5 px-10 mb-5 tableta usuarios shadow-lg rounded-lg">
            <div>
                @if($usuario->imagen)
                    <img class="img-perfil border rounded border-2 border-violet-800" src="{{ asset(str_replace('public/','',$usuario->imagen)) }}" alt="Imagen usuario">
                @else
                    <img class="img-perfil border rounded-full border-2 border-violet-800" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                @endif
            </div>
            <dl>
                <dt class="font-semibold">Nombre:</dt>
                <dd class="mb-5">{{ $usuario->nombre }}</dd>
            </dl>
            <dl>
                <dt class="font-semibold">Contacto:</dt>
                <dd class="underline underline-offset-8 hover:underline-offset-4">{{ $usuario->email }}</dd>
                <dd>{{ $usuario->telefono ?? '-' }}</dd>
            </dl>
        </div>
    @empty
        <div class="flex justify-center items-center w-full px-5 mb-5">
            <h2 class="text-center text-3xl">No hay Datos</h2>
        </div>
    @endforelse
    <div class="flex justify-center items-center flex-col mb-5">
        {{ $usuarios->links() }}
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/selector.js') }}"></script>
@endpush

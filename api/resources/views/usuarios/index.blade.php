<?php
    /**@var \App\Models\Verificados $usuarios*/
    /**@var \App\Models\Admin $seleccionado*/
?>
@extends('layouts.main')
@section('title','Unidos | Usuarios')
@section('main')
    <h1 class="text-center text-3xl mb-10 texto-violeta font-bold">Usuarios</h1>
    <div class="flex justify-center md:justify-between items-center gap-3 flex-wrap">
        <form id="formulario" action="{{ route('usuarios') }}" method="get" class="md:w-1/2 w-full mb-5 px-3 md:px-0">
            <div>
                <label for="usuarios" class="sr-only">Seleccione</label>
                <select name="usuarios" id="usuarios" class="border border-violeta rounded w-full bg-white px-2 py-1">
                    <option value="" {{ $seleccionado === null ? 'selected' : '' }}>Todos</option>
                    <option value="eliminados" {{ $seleccionado === 'eliminados' ? 'selected' : '' }}>Bloqueados</option>
                </select>
            </div>
        </form>
    </div>
    <div id="tarjetas">
        @forelse($usuarios as $usuario)
            <div class="tarjeta verificados">
                <div class="container-img">
                    @if($usuario->imagen)
                        <img src="{{ asset(str_replace('public/','',$usuario->imagen)) }}" alt="Imagen usuario">
                    @else
                        <img src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                    @endif
                </div>
                <h2 class="tipo">Usuario</h2>
                <h3>{{ $usuario->nombre }}</h3>
                <ul>
                    <li>Email: <span>{{ $usuario->email }}</span></li>
                    <li>Tel.: <span>{{ $usuario->telefono }}</span></li>
                </ul>
                @if($usuario->deleted_at)
                    <form action="{{ route('usuarios.restaurar', ['id' => $usuario->id_usuario]) }}" class="w-full">
                        @csrf
                        <button type="submit" class="restaurar px-3 py-3 px-2 my-3 rounded text-center hover:bg-green-700 hover:ease-in-out transition duration-300 hover:text-white text-green-800 w-full">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('usuarios.eliminar', ['id' => $usuario->id_usuario]) }}" method="post" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded text-center py-3 px-2 my-3 block hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar hover:text-white text-red-800 w-full">Eliminar</button>
                    </form>
                @endif
            </div>
        @empty
            <div class="flex justify-center items-center w-full px-5 mb-5">
                <h2 class="text-center text-3xl">No hay Datos</h2>
            </div>
        @endforelse
    </div>
    <div class="flex justify-center items-center flex-col mb-5">
        {{ $usuarios->links() }}
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/selector.js') }}"></script>
@endpush

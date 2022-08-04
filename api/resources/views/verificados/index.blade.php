<?php
    /**@var \App\Models\Verificados $usuarios*/
    /**@var \App\Models\Admin $seleccionado*/
?>
@extends('layouts.main')
@section('title','Unidos | Usuarios')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Usuarios Verificados</h1>
    <div class="flex justify-center md:justify-between items-center gap-3 flex-wrap">
        <form id="formulario" action="{{ route('verificados') }}" method="get" class="md:w-1/2 w-full mb-5 px-3 md:px-0">
            <div>
                <label for="usuarios" class="sr-only">Seleccione</label>
                <select name="usuarios" id="usuarios" class="border border-violet-800 rounded w-full bg-white px-2 py-1">
                    <option value="" {{ $seleccionado === null ? 'selected' : '' }}>Todos</option>
                    <option value="eliminados" {{ $seleccionado === 'eliminados' ? 'selected' : '' }}>Eliminados</option>
                    <option value="verificados" {{ $seleccionado === 'verificados' ? 'selected' : '' }}>Verificados</option>
                    <option value="no-verificados" {{ $seleccionado === 'no-verificados' ? 'selected' : '' }}>No verificados</option>
                </select>
            </div>
        </form>
    </div>
    <div id="tarjetas">
        @forelse($usuarios as $usuario)
            <div class="tarjeta verificados">
                <div class="container-img">
                    <img src="{{ $usuario->imagen ? asset(str_replace('public/','', $usuario->imagen)) : asset('imgs/user-default.png') }}" alt="{{ $usuario->razon_social }}">
                </div>
                <h2 class="tipo">Verificado</h2>
                <h3>{{ $usuario->razon_social }}</h3>
                <ul>
                    <li>Email: <span>{{ $usuario->email }}</span></li>
                    <li>Tel.: <span>{{ $usuario->telefono }}</span></li>
                    <li>Cuit: <span>{{ $usuario->cuit }}</span></li>
                </ul>
                <form action="{{ route('verificados.verificar', ['usuario' => $usuario->id_verificado]) }}" method="post" class="flex flex-col w-full">
                    @csrf
                    @method('PUT')

                    @if( $usuario->status === 1 )
                        <button type="submit" class="w-full py-3 px-2 my-3 rounded border border-violet-600 text-center text-violet-800 hover:ease-in-out hover:text-white hover:bg-violet-800 transition duration-300">No Verificar</button>
                    @else
                        <button type="submit" class="w-full py-3 px-2 my-3 rounded border-violet-800 text-center bg-violet-800 text-white">Verificar</button>
                    @endif
                </form>
                @if($usuario->deleted_at)
                    <form action="{{ route('verificados.restaurar', ['usuario' => $usuario->id_verificado]) }}" class="w-full">
                        @csrf
                        <button type="submit" class="restaurar rounded text-center py-3 px-2 my-3 block hover:bg-green-600 transition hover:ease-in-out duration-300 hover:text-white text-green-600 w-full">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('verificados.eliminar', ['usuario' => $usuario->id_verificado]) }}" method="post" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded mt-5 text-center py-3 px-2 block w-full text-red-600 hover:text-white hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar">Eliminar</button>
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

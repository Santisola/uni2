<?php
    /**@var \App\Models\Verificados $usuarios*/
    /**@var \App\Models\Admin $seleccionado*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Usuarios')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Usuarios Verificados</h1>
    <div class="flex justify-center md:justify-between items-center gap-3 flex-wrap">
        <form id="formulario" action="{{ route('usuarios') }}" method="get" class="md:w-1/2 w-full mb-5 px-3 md:px-0">
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
    @forelse($usuarios as $usuario)
        <div class="flex flex-wrap justify-between items-center w-full py-5 px-10 mb-5 tableta verificados shadow-lg rounded-lg">
            <div>
                @if($usuario->imagen)
                    <img class="img-perfil border rounded border-2 border-violet-800" src="{{ asset(str_replace('public/','',$usuario->imagen)) }}" alt="Imagen usuario">
                @else
                    <img class="img-perfil border rounded-full border-2 border-violet-800" src="{{ asset('imgs/user-default.png') }}" alt="Default usuario">
                @endif
            </div>
            <dl>
                <dt class="sr-only">Cuit:</dt>
                <dd class="mb-5">{{ $usuario->cuit }}</dd>
                <dt class="sr-only">Razón social:</dt>
                <dd class="mb-5">{{ $usuario->razon_social }}</dd>
                <dt class="sr-only">Verificado:</dt>
                @if($usuario->status === 1)
                    <dd class="text-violet-800 font-semibold">Verificado</dd>
                @else
                    <dd class="text-violet-800 font-semibold">No verificado</dd>
                @endif
            </dl>
            <dl>
                <dt class="font-semibold">Contacto:</dt>
                <dd class="underline underline-offset-8 hover:underline-offset-4">{{ $usuario->email }}</dd>
                <dd>{{ $usuario->telefono ?? '-' }}</dd>
            </dl>
            <div>
                <form action="{{ route('usuarios.verificar', ['usuario' => $usuario->id_verificado]) }}" method="post" class="flex flex-col">
                    @csrf
                    @method('PUT')

                    @if( $usuario->status === 1 )
                        <button type="submit" class="w-full py-3 px-2 my-3 rounded border border-violet-800 text-center text-violet-800 hover:ease-in-out hover:text-white hover:bg-violet-800 transition duration-300">No Verificar</button>
                    @else
                        <button type="submit" class="w-full py-3 px-2 my-3 rounded border-violet-800 text-center bg-violet-800 text-white">Verificar</button>
                    @endif
                </form>
                @if($usuario->deleted_at)
                    <form action="{{ route('usuarios.restaurar', ['usuario' => $usuario->id_verificado]) }}">
                        @csrf
                        <button type="submit" class="rounded text-center py-3 px-2 mt-3 block w-full bg-teal-500 hover:bg-teal-600 transition hover:ease-in-out duration-300">Restaurar</button>
                    </form>
                @else
                    <form action="{{ route('usuarios.eliminar', ['usuario' => $usuario->id_verificado]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded text-center py-3 px-2 my-3 block w-full bg-red-500 hover:bg-red-600 transition hover:ease-in-out duration-300">Eliminar</button>
                    </form>
                @endif
            </div>
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

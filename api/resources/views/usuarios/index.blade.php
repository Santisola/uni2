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
                    <option value="eliminados" {{ $seleccionado === 'ban' ? 'selected' : '' }}>Eliminados</option>
                    <option value="verificados" {{ $seleccionado === 'verificados' ? 'selected' : '' }}>Verificados</option>
                    <option value="no-verificados" {{ $seleccionado === 'no-verificados' ? 'selected' : '' }}>No verificados</option>
                </select>
            </div>
        </form>
    </div>
    <div class="overflow-x-auto pb-20">
        <table class="table table-auto mx-auto px-10 w-full">
            <thead class="border">
            <tr>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Cuit</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Razón Social</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Teléfono</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Email</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Imagen</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Status</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Fecha de registro</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Última actualización</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Acciones</th>
            </tr>
            </thead>
            <tbody class="whitespace-nowrap px-5 border">
            @forelse($usuarios as $usuario)
                <tr class="{{ $usuario->deleted_at ? 'bg-red-300' : 'bg-white' }}">
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->cuit }}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->razon_social }}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->telefono ?? '-' }}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->email}}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->imagen ?? '-'}}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">
                    @if($usuario->status === 1)
                        <td class="text-center whitespace-nowrap px-5 border align-middle text-violet-800 font-semibold">Verificado</td>
                    @else
                        <td class="text-center whitespace-nowrap px-5 border align-middle text-violet-800 font-semibold">No verificado</td>
                    @endif
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->created_at}}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->updated_at}}</td>
                    <td class="whitespace-nowrap px-5 border align-middle flex flex-col">
                        <form action="{{ route('usuarios.verificar', ['usuario' => $usuario->id_verificado]) }}" method="post">
                            @csrf
                            @method('PUT')

                            @if( $usuario->status === 1 )
                                <button type="submit" class="w-full px-3 py-1 my-3 rounded border border-violet-800 text-center text-violet-800 hover:ease-in-out hover:text-white hover:bg-violet-800 transition duration-300">No Verificar</button>
                            @else
                                <button type="submit" class="w-full px-3 py-1 my-3 rounded border-violet-800 text-center bg-violet-800 text-white">Verificar</button>
                            @endif
                        </form>
                        @if($usuario->deleted_at)
                            <form action="{{ route('usuarios.restaurar', ['usuario' => $usuario->id_verificado]) }}">
                                @csrf
                                <button type="submit" class="w-full px-3 py-1 my-3 rounded text-center bg-green-600 hover:bg-green-700 hover:ease-in-out transition duration-300 text-white">Restaurar</button>
                            </form>
                        @else
                            <form action="{{ route('usuarios.eliminar', ['usuario' => $usuario->id_verificado]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-3 py-1 my-3 rounded text-center bg-red-600 hover:bg-red-700 hover:ease-in-out transition duration-300 text-white">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center text-2xl font-bold py-5">No hay datos</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="flex justify-center items-center flex-col mb-5">
        {{ $usuarios->links() }}
    </div>
@endsection
@push('js')
    <script>
        const formulario = document.querySelector('#formulario');
        const select = document.querySelector('#usuarios');

        select.addEventListener('change', () => {
           formulario.submit();
        });
    </script>
@endpush

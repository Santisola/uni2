<?php
    /**@var \App\Models\Verificados $usuarios*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Usuarios')
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Usuarios</h1>
    <div class="overflow-x-scroll xl:overflow-x-hidden pb-20">
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
                <tr>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->cuit }}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->razon_social }}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->telefono ?? '-' }}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->email}}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->imagen ?? '-'}}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">{{ $usuario->status === 1 ? 'Verificado' : 'No verificado' }}</td>
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
                        <form action="{{ route('usuarios.eliminar', ['usuario' => $usuario->id_verificado]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-1 my-3 rounded text-center bg-red-600 hover:bg-red-700 hover:ease-in-out transition duration-300 text-white">Ban</button>
                        </form>
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

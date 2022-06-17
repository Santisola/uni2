<?php
    /**@var \App\Models\Verificados $usuarios*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Usuarios')
@section('main')
    <div class="container mt-3">
        <h1 class="text-center">Usuarios</h1>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th class="align-middle text-center">Cuit</th>
                    <th class="align-middle text-center">Razón Social</th>
                    <th class="align-middle text-center">Teléfono</th>
                    <th class="align-middle text-center">Email</th>
                    <th class="align-middle text-center">Imagen</th>
                    <th class="align-middle text-center">Status</th>
                    <th class="align-middle text-center">Fecha de registro</th>
                    <th class="align-middle text-center">Última actualización</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr>
                        <td class="align-middle">{{ $usuario->cuit }}</td>
                        <td class="align-middle">{{ $usuario->razon_social }}</td>
                        <td class="align-middle">{{ $usuario->telefono ?? '-' }}</td>
                        <td class="align-middle">{{ $usuario->email}}</td>
                        <td class="align-middle">{{ $usuario->imagen ?? '-'}}</td>
                        <td class="align-middle">{{ $usuario->status === 1 ? 'Verificado' : 'No verificado' }}</td>
                        <td class="align-middle">{{ $usuario->created_at}}</td>
                        <td class="align-middle">{{ $usuario->updated_at}}</td>
                    </tr>
                @empty
                <tr>
                    <td colspan="100%" class="text-center h2">No hay datos</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

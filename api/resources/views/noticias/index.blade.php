<?php
/**@var \App\Models\Noticias $noticias*/
use Illuminate\Support\Str;
?>
@extends('layouts.main')
@section('title','UNIDOS | Noticias')
@section('main')
    <div class="container">
        <h1 class="text-center">Noticias</h1>
        <a class="btn btn-primary" role="button" href="{{ route('noticias.crearForm') }}">Añadir nueva noticia</a>
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th class="align-middle text-center">Titulo</th>
                    <th class="align-middle text-center">Contenido</th>
                    <th class="align-middle text-center">Imagen</th>
                    <th class="align-middle text-center">Status</th>
                    <th class="align-middle text-center">Fecha de creación</th>
                    <th class="align-middle text-center">Fecha última actualización</th>
                </tr>
            </thead>
            <tbody>
                @forelse($noticias as $noticia)
                    <tr>
                        <td>{{ $noticia->titulo }}</td>
                        <td>{{ Str::limit($noticia->contenido, 50) }}</td>
                        @if(!$noticia->imagen)
                            <td>-</td>
                        @else
                            <td>
                                @if(str_contains('www',$noticia->imagen) || str_contains('http',$noticia->imagen))
                                    <img class="img-thumbnail" src="{{ $noticia->imagen }}" alt="{{ $noticia->titulo }} imagen">
                                @else
                                    <img class="img-thumbnail" src="{{ asset('imgs/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }} imagen">
                                @endif
                            </td>
                        @endif
                        <td>{{ $noticia->status === 1 ? 'Publicado' : 'Borrador' }}</td>
                        <td>{{ $noticia->created_at }}</td>
                        <td>{{ $noticia->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center h1">No hay noticias creadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

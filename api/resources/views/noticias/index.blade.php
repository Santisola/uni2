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
                    <th class="align-middle text-center">Acciones</th>
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
                                <img class="img-thumbnail" src="{{ asset('imgs/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }} imagen">
                            </td>
                        @endif
                        <td>{{ $noticia->publicado === 1 ? 'Publicado' : 'Borrador' }}</td>
                        <td>{{ date('d/m/Y H.i:s', strtotime($noticia->created_at)) }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($noticia->updated_at)) }}</td>
                        <td>
                            <div class="d-flex flex-column">
                                <a class="btn btn-info" href="{{ route('noticias.detalle', ['noticia' => $noticia->id_noticia]) }}">Detalle</a>
                                <a class="mt-2 btn btn-warning" href="{{ route('noticias.editarForm', ['noticia' => $noticia->id_noticia]) }}">Editar</a>
                                <a href="{{ route('noticias.eliminar', ['noticia' => $noticia->id_noticia]) }}" class="mt-2 btn btn-danger">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100%" class="text-center h1">No hay noticias creadas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Button trigger modal -->
    <button id="btn-modal" type="button" class="sr-only btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea eliminar esta noticia? Una vez eliminada no habrá paso atrás.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <form action="" id="formulario" onsubmit="continuar()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const btnEliminar = document.querySelectorAll('.btn-danger');
        const formulario = document.querySelector('#formulario');

        btnEliminar.forEach(btn => {
            btn.addEventListener('click', preventEliminar);
        });

        function preventEliminar(e) {
            e.preventDefault();

            const tituloModal = document.querySelector('.modal-title');
            const abrirModal = document.querySelector('#btn-modal');

            formulario.action = e.target.href;
            tituloModal.textContent = e.target.parentNode.parentNode.parentNode.firstElementChild.textContent;

            abrirModal.click();
        }

        function continuar() {
            formulario.submit();
        }
    </script>
@endpush

<?php
/**@var \App\Models\Noticias $noticias*/
/**@var \App\Models\Admin $seleccionado*/
?>
@extends('layouts.main')
@section('title','Unidos | Noticias')
@section('main')
    <div class="container">
        <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Noticias</h1>
        <div class="flex flex-wrap justify-between items-center">
            <form action="{{ route('noticias') }}" method="get" class="block w-1/2 mb-5 flex md:justify-start items-center flex-wrap">
                @csrf
                <div class="w-2/3">
                    <label for="titulo" class="sr-only">Buscar noticia por título</label>
                    <input
                        type="text"
                        id="titulo"
                        name="titulo"
                        class="px-2 py-1 border border-violet-800 rounded block w-full"
                        placeholder="Escriba el título que desea buscar"
                        value="{{ $seleccionado ?? '' }}"
                    >
                </div>
                <div class="pl-5">
                    <button type="submit" class="border-violet-800 border rounded bg-violet-800 text-white text-center block w-fit uppercase px-5 py-1 hover:border-double transition hover:ease-in-out duration-300 hover:border-violet-600">Buscar</button>
                </div>
            </form>
            <a class="rounded block w-fit px-2 py-3 text-white bg-violet-800 hover:ease-in-out transition duration-300 hover:bg-violet-900 md:ml-3" role="button" href="{{ route('noticias.crearForm') }}">Añadir nueva noticia</a>
        </div>
    </div>
    <div id="tarjetas">
        @forelse($noticias as $noticia)
            <div class="tarjeta verificados">
                <div class="container-img">
                    <img src="{{ asset('imgs/noticias/') . '/' . $noticia->imagen }}" alt="{{ $noticia->titulo }}">
                </div>
                <h2 class="tipo">Noticias</h2>
                <h3>{{ $noticia->titulo }}</h3>
                <ul>
                    <li>Fecha: <span>{{ date('d/m/Y H:i:s', strtotime($noticia->created_at)) }}</span></li>
                    <li>Estado: <span>{{ $noticia->publicado === 1 ? 'Publicado' : 'Borrador' }}</span></li>
                </ul>
                <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-yellow-500 hover:bg-yellow-600 transition hover:ease-in-out duration-300" href="{{ route('noticias.detalle', ['noticia' => $noticia->id_noticia]) }}">Detalle</a>
                <a class="w-full py-3 px-2 my-3 rounded border border-violet-600 text-center text-violet-800 hover:ease-in-out hover:text-white hover:bg-violet-800 transition duration-300" href="{{ route('noticias.editarForm', ['noticia' => $noticia->id_noticia]) }}">Editar</a>
                <a href="{{ route('noticias.eliminar', ['noticia' => $noticia->id_noticia]) }}" class="rounded text-center py-3 px-2 block w-full text-red-800 hover:text-white hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar">Eliminar</a>
            </div>
        @empty
            <div class="flex justify-center items-center w-full px-5 mb-5">
                <h2 class="text-center text-3xl">No hay Datos</h2>
            </div>
        @endforelse
    </div>
    <div class="flex justify-center items-center flex-col mb-5">
        {{ $noticias->links() }}
    </div>
    <!-- Modal -->
    <div id="modal" class="hidden h-screen w-screen max-w-full fixed top-0 left-0 flex justify-center items-center" onclick="cerrar()">
        <div class="bg-white relative z-10 p-5 rounded max-w-fit w-full">
            <div class="modal-header mb-5 border border-t-transparent border-l-transparent border-r-transparent border-b-slate-700 flex justify-between items-center pb-3">
                <p class="modal-title text-2xl">Contenido</p>
                <button type="button" onclick="cerrar()">
                    <span class="text-xl">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar esta noticia? Una vez eliminada no habrá vuelta atrás.
            </div>
            <div class="modal-footer flex justify-end items-center gap-1 mt-5">
                <button type="button" class="block w-fit border rounded bg-slate-700 text-white transition duration-300 hover:ease-in-out px-3 py-1" onclick="cerrar()">Cerrar</button>
                <form action="" id="formulario" onsubmit="continuar()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border rounded w-fit block transition duration-300 hover:ease-in-out hover:text-white border-red-500 hover:bg-red-700 px-3 py-1 text-red-600">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const btnEliminar = document.querySelectorAll('.eliminar');
        const formulario = document.querySelector('#formulario');
        const modal = document.querySelector('#modal');

        btnEliminar.forEach(btn => {
            btn.addEventListener('click', preventEliminar);
        });

        function preventEliminar(e) {
            e.preventDefault();

            const tituloModal = document.querySelector('.modal-title');

            formulario.action = e.target.href;

            tituloModal.textContent = e.target.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.lastElementChild.textContent;

            modal.classList.remove('hidden');
        }

        function continuar() {
            formulario.submit();
        }

        function cerrar() {
            if(!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
            }
        }
    </script>
@endpush

<?php
/**@var \App\Models\Noticias $noticias*/
use Illuminate\Support\Str;
?>
@extends('layouts.main')
@section('title','UNIDOS | Noticias')
@section('main')
    <div class="container">
        <h1 class="text-center text-3xl mb-5">Noticias</h1>
    </div>
    <a class="md:ml-auto md:mr-0 rounded-t-lg block w-fit px-2 py-3 text-white bg-violet-800 hover:ease-in-out transition duration-300 hover:bg-violet-900" role="button" href="{{ route('noticias.crearForm') }}">Añadir nueva noticia</a>
    <div class="overflow-x-scroll xl:overflow-x-hidden pb-20">
        <table class="table table-auto mx-auto px-10 w-full">
            <thead class="border">
            <tr>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Titulo</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Contenido</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Imagen</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Status</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Fecha de creación</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Fecha última actualización</th>
                <th class="whitespace-nowrap px-5 border align-middle text-center">Acciones</th>
            </tr>
            </thead>
            <tbody class="border">
            @forelse($noticias as $noticia)
                <tr>
                    <td class="text-xl font-bold text-center px-5 border align-middle">{{ $noticia->titulo }}</td>
                    <td class="text-lg font-semibold px-5 border align-middle">{{ Str::limit($noticia->contenido, 50) }}</td>
                    @if(!$noticia->imagen)
                        <td class="whitespace-nowrap px-5 border align-middle">-</td>
                    @else
                        <td class="whitespace-nowrap px-5 border align-middle">
                            <img class="img-thumbnail" src="{{ asset('imgs/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }} imagen">
                        </td>
                    @endif
                    <td class="text-center whitespace-nowrap px-5 border align-middle">{{ $noticia->publicado === 1 ? 'Publicado' : 'Borrador' }}</td>
                    <td class="text-center whitespace-nowrap px-5 border align-middle">{{ date('d/m/Y H.i:s', strtotime($noticia->created_at)) }}</td>
                    <td class="text-center whitespace-nowrap px-5 border align-middle">{{ date('d/m/Y H:i:s', strtotime($noticia->updated_at)) }}</td>
                    <td class="whitespace-nowrap px-5 border align-middle">
                        <div class="flex flex-col">
                            <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-teal-500 hover:bg-teal-600 transition hover:ease-in-out duration-300" href="{{ route('noticias.detalle', ['noticia' => $noticia->id_noticia]) }}">Detalle</a>
                            <a class="rounded text-center py-3 px-2 mt-3 block w-full bg-yellow-500 hover:bg-yellow-600 transition hover:ease-in-out duration-300" href="{{ route('noticias.editarForm', ['noticia' => $noticia->id_noticia]) }}">Editar</a>
                            <a href="{{ route('noticias.eliminar', ['noticia' => $noticia->id_noticia]) }}" class="rounded text-center py-3 px-2 my-3 block w-full bg-red-500 hover:bg-red-600 transition hover:ease-in-out duration-300">Eliminar</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100%" class="text-center text-2xl font-bold py-5">No hay noticias creadas.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
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
                ¿Está seguro que desea eliminar esta noticia? Una vez eliminada no habrá paso atrás.
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
        const btnEliminar = document.querySelectorAll('.bg-red-500');
        const formulario = document.querySelector('#formulario');
        const modal = document.querySelector('#modal');

        btnEliminar.forEach(btn => {
            btn.addEventListener('click', preventEliminar);
        });

        function preventEliminar(e) {
            e.preventDefault();

            const tituloModal = document.querySelector('.modal-title');

            formulario.action = e.target.href;
            tituloModal.textContent = e.target.parentNode.parentNode.parentNode.firstElementChild.textContent;

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

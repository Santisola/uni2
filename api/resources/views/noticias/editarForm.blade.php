<?php
/**@var \App\Models\Noticias $noticia*/
?>
@extends('layouts.main')
@section('title','UNIDOS | Editar: ' . $noticia->titulo)
@section('main')
    <div class="container">
        <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">Editar noticia</h1>
        <form action="{{ route('noticias.editar', ['noticia' => $noticia->id_noticia]) }}" method="post" enctype="multipart/form-data" id="formulario" class="border border-violet-800 rounded p-5 w-full flex justify-center items-center flex-col md:flex-row mx-auto flex-wrap max-w-xl mb-10">
            @csrf
            @method('PUT')
            <div class="w-full md:w-1/2 flex flex-col md:px-1">
                <label for="titulo" class="mb-1">Título</label>
                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Ingrese el título de la noticia aquí"
                    class="border rounded px-2 py-1"
                    @error('titulo') aria-describedby="error-titulo" @enderror
                    value="{{ old('titulo',$noticia->titulo) }}"
                >
                @error('titulo')
                <p class="text-red-800 bg-red-300 text-center rounded" id="error-titulo">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 flex flex-col md:px-1">
                <label for="slug" class="mb-1">Slug</label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    placeholder="Ingrese la url de la noticia"
                    class="border rounded px-2 py-1"
                    @error('slug') aria-describedby="error-slug" @enderror
                    value="{{ old('slug', $noticia->slug) }}"
                >
                @error('slug')
                <p class="text-red-800 bg-red-300 text-center rounded" id="error-slug">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-5 flex flex-col md:px-1 w-full">
                <label for="contenido" class="mb-1">Contenido</label>
                <textarea
                    id="contenido"
                    name="contenido"
                    placeholder="Ingrese el contenido de la noticia aquí"
                    class="border rounded w-full h-36 px-2"
                    @error('contenido') aria-describedby="error-contenido" @enderror
                >{{ old('contenido', $noticia->contenido) }}</textarea>
                @error('contenido')
                <p class="text-red-800 bg-red-300 text-center rounded" id="error-contenido">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-5 flex flex-col md:px-1 w-full">
                <label for="imagen" class="mb-1">Imagen</label>
                <input
                    type="file"
                    accept="image/*"
                    id="imagen"
                    name="imagen"
                    placeholder="Ingrese la imagen de la noticia aquí"
                    class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"
                    @error('imagen') aria-describedby="error-imagen" @enderror
                >
                @error('imagen')
                <p class="text-red-800 bg-red-300 text-center rounded" id="error-imagen">{{ $message }}</p>
                @enderror
                <p class="mt-3">Imagen actual:</p>
                <img id="img-preview" class="img-thumbnail" src="{{ asset('imgs/noticias/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }} imagen">
                @error('imagen')
                <p class="text-red-800 bg-red-300 text-center rounded" id="error-imagen">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="publicado" id="publicado">
            <div class="mt-5">
                <div class="botones">
                    <button id="publicar" type="button" class="rounded bg-violet-800 text-white px-5 py-1">Publicar</button>
                    <button id="borrador" type="button" class="rounded border-violet-800 hover:bg-violet-800 text-violet-800 hover:text-white px-5 py-1 border-violet-800 border duration-300 transition">Guardar borrador</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        const titulo = document.querySelector('#titulo');
        const slug = document.querySelector('#slug');

        titulo.addEventListener('input', handleSlug);
        slug.addEventListener('input',handleSlug);

        function handleSlug(e) {
            slug.value = e.target.value.replaceAll(' ','-').toLowerCase();
        }
    </script>
    <script>
        const publicar = document.querySelector('#publicar');
        const borrador = document.querySelector('#borrador');

        publicar.addEventListener('click', () => {
            handleStatus(1);
        });
        borrador.addEventListener('click', () => {
            handleStatus(0);
        });

        function handleStatus(numero) {
            const input = document.querySelector('[name="publicado"]');
            const formulario = document.querySelector('#formulario');

            input.value = numero;

            formulario.submit();
        }
    </script>
    <script>
        const imgPreview = document.querySelector('#img-preview');
        const inputImagen = document.querySelector('#imagen');

        inputImagen.addEventListener('change', handleImagen);

        function handleImagen(e) {
            imgPreview.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
@endpush

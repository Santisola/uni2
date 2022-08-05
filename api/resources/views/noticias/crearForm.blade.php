@extends('layouts.main')
@section('title','Unidos | Crear una nueva noticia')
@section('main')
    <div class="container">
        <h1 class="text-center text-3xl mb-10 texto-violeta font-bold">Crear una nueva noticia</h1>
        <form action="{{ route('noticias.crear') }}" method="post" id="formulario" enctype="multipart/form-data" class="border border-violeta rounded p-5 w-full flex justify-center items-center flex-col md:flex-row mx-auto flex-wrap max-w-xl">
            @csrf
            <div class="w-full md:w-1/2 flex flex-col md:px-1">
                <label for="titulo" class="mb-1">Título</label>
                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Ingrese el título de la noticia aquí"
                    class="border rounded px-2 py-1"
                    @error('titulo') aria-describedby="error-titulo" @enderror
                    value="{{ old('titulo','') }}"
                >
                @error('titulo')
                    <p class="text-red-800 bg-red-300 py-3 rounded my-10 text-center" id="error-titulo">{{ $message }}</p>
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
                    value="{{ old('slug','') }}"
                >
                @error('slug')
                <p class="text-red-800 bg-red-300 py-3 rounded my-10 text-center" id="error-slug">{{ $message }}</p>
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
                >{{ old('contenido','') }}</textarea>
                @error('contenido')
                    <p class="text-red-800 bg-red-300 py-3 rounded my-10 text-center" id="error-contenido">{{ $message }}</p>
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
                    class="file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition ease-in-out cursor-pointer"
                    @error('imagen') aria-describedby="error-imagen" @enderror
                >
                @error('imagen')
                    <p class="text-red-800 bg-red-300 py-3 rounded my-10 text-center" id="error-imagen">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="publicado" id="publicado">
            <div class="mt-5">
                <div class="botones">
                    <button id="publicar" type="button" class="rounded bg-violeta text-white px-5 py-1">Publicar</button>
                    <button id="borrador" type="button" class="rounded hover:bg-violeta texto-violeta hover:text-white px-5 py-1 border-violeta border duration-300 transition">Guardar borrador</button>
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
        const inputFile = document.querySelector('#imagen');

        inputFile.addEventListener('change',showPreview);

        function showPreview(e) {
            const imagen = e.target.files[0];
            const preview = URL.createObjectURL(imagen);

            if (document.querySelector('.preview')) {
                document.querySelector('.preview').src = preview;
            } else {
                const img = document.createElement('img');
                img.setAttribute('src',preview);
                img.setAttribute('alt','preview');
                img.classList.add('preview');

                e.target.insertAdjacentElement('afterend',img);
            }
        }
    </script>
@endpush

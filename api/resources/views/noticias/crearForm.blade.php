@extends('layouts.main')
@section('title','UNIDOS | Crear una nueva noticia')
@section('main')
    <div class="container">
        <h1 class="text-center">Añadir una nueva noticia</h1>
        <form action="{{ route('noticias.crear') }}" method="post" id="formulario" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="titulo">Título</label>
                <input
                    type="text"
                    id="titulo"
                    name="titulo"
                    placeholder="Ingrese el título de la noticia aquí"
                    class="form-control"
                    @error('titulo') aria-describedby="error-titulo" @enderror
                    value="{{ old('titulo','') }}"
                >
                @error('titulo')
                    <p class="alert alert-danger" id="error-titulo">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea
                    id="contenido"
                    name="contenido"
                    placeholder="Ingrese el contenido de la noticia aquí"
                    class="form-control"
                    @error('contenido') aria-describedby="error-contenido" @enderror
                >
                    {{ old('contenido','') }}
                </textarea>
                @error('contenido')
                    <p class="alert alert-danger" id="error-contenido">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input
                    type="file"
                    accept="image/*"
                    id="imagen"
                    name="imagen"
                    placeholder="Ingrese la imagen de la noticia aquí"
                    class="form-control-file"
                    @error('imagen') aria-describedby="error-imagen" @enderror
                >
                @error('imagen')
                    <p class="alert alert-danger" id="error-imagen">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    placeholder="Ingrese la url de la noticia"
                    class="form-control"
                    @error('slug') aria-describedby="error-slug" @enderror
                    value="{{ old('slug','') }}"
                >
                @error('slug')
                    <p class="alert alert-danger" id="error-slug">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="publicado" id="publicado">
            <div class="form-group">
                <div class="botones">
                    <button id="publicar" type="button" class="btn btn-primary">Publicar</button>
                    <button id="borrador" type="button" class="btn btn-outline-primary">Guardar borrador</button>
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
@endpush

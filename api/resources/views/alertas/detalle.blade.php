<?php
/**@var \App\Models\Alerta $alerta*/
?>
@extends('layouts.main')
@section('title','Unidos | Detalle Alerta')
@section('links')
    <link rel="stylesheet" href="<?= url('css/animate.css');?>">
    <link rel="stylesheet" href="<?= url('css/owl.carousel.min.css') ;?>">
@endsection
@section('main')
    <div id="alerta" class="container-2xl mb-5">
        <div class="flex flex-wrap">
            <div class="text-center md:w-1/2 w-full">
                <ul class="detalle-alerta-imgs owl-carousel owl-theme">
                    @foreach ($alerta->imagenes as $img)
                        <li class="item">
                            <img class="max-w-4xl mx-auto w-full" src="{{ asset('imgs/mascotas/' . $img) }}" alt="{{ $alerta->nombre ?? 'Imagen de la mascota' }}">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center md:w-1/2 w-full px-10 flex flex-col justify-between">
                <div>
                    <h1 class="mt-5 text-2xl font-bold texto-violeta mb-10">{{ $alerta->nombre ?? 'Detalle de la mascota' }}</h1>
                    <p class="mt-2 whitespace-pre-line mb-10 break-words detalle md:text-start">{{ $alerta->descripcion }}</p>
                    <ul class="mt-10">
                        <li class="text-sm text-left text-zinc-500">Fecha: {{ date('d/m/Y', strtotime($alerta->fecha)) }} {{ date('d/m/Y', strtotime($alerta->hora)) }}hs</li>
                        <li class="mt-2 text-sm text-left text-zinc-500">Especie: {{$alerta->especie->especie}}</li>
                        <li class="mt-2 text-sm text-left text-zinc-500">Raza: {{$alerta->raza->raza ?? 'Desconocida'}}</li>
                        <li class="mt-2 text-sm text-left text-zinc-500">Sexo: {{$alerta->sexo->sexo ?? 'Desconocido'}}</li>
                    </ul>
                    <iframe src="https://maps.google.com/maps?q={{ $alerta->latitud }},{{ $alerta->longitud }}&z=15&output=embed" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="iframe-google"></iframe>
                </div>
            </div>
        </div>
        @if($alerta->deleted_at)
            <form action="{{ route('alertas.restaurar', ['alerta' => $alerta->id_alerta]) }}">
                @csrf
                <button type="submit" class="w-full px-3 py-3 px-2 my-3 rounded text-center bg-green-600 hover:bg-green-700 hover:ease-in-out transition duration-300 text-white">Restaurar</button>
            </form>
        @else
            <form action="{{ route('alertas.eliminar', ['alerta' => $alerta->id_alerta]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded mt-5 text-center py-3 px-2 block w-full text-red-800 hover:text-white hover:bg-red-600 transition hover:ease-in-out duration-300 eliminar">Eliminar</button>
            </form>
        @endif
    </div>
    <script src="<?= url('js/app.js') ;?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= url('js/owl.carousel.min.js') ;?>"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            animateOut: 'fadeOut',
            items:1,
            margin:30,
            stagePadding:0,
            smartSpeed:450,
            autoplay: true,
            autoplayTimeout:5000,
            autoplayHoverPause:false,
            loop: true,
            mouseDrag: true,
            arrows: true,
        });
    </script>
@endsection

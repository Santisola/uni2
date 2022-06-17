@extends('layouts.main')
@section('title', 'UNIDOS | Iniciar Sesión')
@section('main')
<div class="h80">
    <h1 class="text-center mt-5">Iniciar Sesión</h1>
    <form action="{{ route('auth.login') }}" method="post" class="mx-auto w-75">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                class="form-control"
                placeholder="Ingrese aquí su email"
                value="{{ old('email','') }}"
            >
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese aquí su contraseña">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Ingresar</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.main')
@section('title', 'UNIDOS | Iniciar Sesión')
@section('main')
<div id="login" class="container h-96 m-auto flex justify-center items-center flex-col">
    <h1 class="text-center mb-5 text-3xl">Iniciar Sesión</h1>
    <form action="{{ route('auth.login') }}" method="post" class="mx-auto md:max-w-lg w-full px-5 md:px-0">
        @csrf
        <div class="mb-5">
            <label for="email" class="mb-2 block">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                class="border rounded border-gray-200 w-full py-2 pl-1"
                placeholder="Ingrese aquí su email"
                value="{{ old('email','') }}"
            >
        </div>
        <div class="mb-10">
            <label for="password"  class="mb-2 block">Contraseña</label>
            <input type="password"
                   id="password"
                   name="password"
                   class="border rounded border-gray-200 w-full py-2 pl-1"
                   placeholder="Ingrese aquí su contraseña">
        </div>
        <div>
            <button type="submit" class="rounded transition hover:ease-in-out duration-300 py-3 uppercase w-full bg-violet-800 hover:bg-violet-900 text-white">Ingresar</button>
        </div>
    </form>
</div>
@endsection
@push('js')
    <script>
        const emailInput = document.querySelector('#email');
        const passwordInput = document.querySelector('#password');

        emailInput.addEventListener('blur', handleInputs);
        passwordInput.addEventListener('blur', handleInputs);

        function handleInputs(e) {
            if(e.target.value === '') {
                const small = document.createElement('small');
                small.textContent = 'Este campo no puede estar vacío';
                small.className = 'bg-red-300 text-red-800 block py-3 text-center mt-2';
                e.target.insertAdjacentElement('afterend',small);
                e.target.classList.add('border-rose-500');
            } else {
                if (e.target.nextElementSibling) {
                    e.target.nextElementSibling.remove();
                    e.target.classList.remove('border-rose-500');
                }
            }
        }
    </script>
@endpush

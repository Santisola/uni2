<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'UNIDOS - Administrador')</title>
    <link rel="stylesheet" href="<?= url('css/app.css');?>">
    <link rel="stylesheet" href="<?= url('css/estilos.css');?>">
    <link rel="icon" href="{{ asset('/imgs/logo-unidos.png') }}">
    @stack('css')
</head>
<body>
@auth
<header class="bg-violet-800 mb-10 py-3">
    <div class="container">
        <nav class="flex justify-start items-center">
            <a class="text-white text-2xl block md:mr-14" href="<?= url('/') ;?>"><img id="logo" src="{{ asset('imgs/logo.svg') }}" alt="Logo Unidos"></a>
            <button class="md:hidden">
                <span id="menu">Menu</span>
            </button>
            <div class="flex flex-col md:flex-row justify-start md:justify-between items-center w-full" id="nav">
                <ul class="flex md:flex-row justify-start md:justify-between items-center">
                    <li class="hover:bg-white-100">
                        <a href="<?= url('/usuarios') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:text-slate-50 <?= url()->current() == url('/usuarios') ? 'text-white' : '';?>">Usuarios Verificados</a>
                    </li>
                    <li class="hover:bg-white-100">
                        <a href="<?= url('/noticias') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:bg-white-100 hover:text-slate-50 <?= url()->current() == url('/noticias') ? 'text-white' : '';?>">Noticias</a>
                    </li>
                    <li class="hover:bg-white-100">
                        <a href="<?= url('/eventos') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:bg-white-100 hover:text-slate-50 <?= url()->current() == url('/eventos') ? 'text-white' : '';?>">Eventos</a>
                    </li>
                    <li class="hover:bg-white-100">
                        <a href="<?= url('/alertas') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:bg-white-100 hover:text-slate-50 <?= url()->current() == url('/alertas') ? 'text-white' : '';?>">Alertas</a>
                    </li>
                </ul>
                <a href="<?= url('/logout') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:bg-white-100 hover:text-slate-50">Cerrar Sesión</a>
            </div>
        </nav>
    </div>
</header>
@endauth
<main class="container mx-auto">
    @if(Session::has('message'))
        <div class="mb-10 py-3 {{ Session::get('message_type') ?? 'bg-green-300 text-green-800' }} text-center">{{ Session::get('message') }}</div>
    @endif
    @yield('main')
</main>
<footer class="footer bg-zinc-800 text-center p-10">
    <p class="text-center text-white">Copyright&copy; Unidos {{ now()->year }}</p>
</footer>
<script src="<?= url('js/app.js') ;?>"></script>
@stack('js')
</body>
</html>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Unidos - Administrador')</title>
    <link rel="stylesheet" href="<?= url('css/app.css');?>">
    <link rel="stylesheet" href="<?= url('css/estilos.css');?>">
    <link rel="icon" href="{{ asset('/imgs/logo-unidos.png') }}">
    @stack('css')
    @yield('links')
</head>
<body class="overflow-x-hidden">
@auth
<header class="bg-violeta mb-10 py-5">
    <div class="container">
        <nav class="flex md:justify-start justify-between items-center">
            <a class="text-white text-2xl block md:mr-14" href="<?= url('/') ;?>"><img id="logo" src="{{ asset('imgs/logo.svg') }}" alt="Logo Unidos"></a>
            <button id="menu" class="md:hidden">
                <svg class="ham hamRotate ham8" viewBox="0 0 100 100" width="80" onclick="this.classList.toggle('active')">
                    <path
                        class="line top"
                        d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20" />
                    <path
                        class="line middle"
                        d="m 30,50 h 40" />
                    <path
                        class="line bottom"
                        d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20" />
                </svg>
            </button>
            <div class="flex flex-col md:flex-row justify-start md:justify-between items-center w-full" id="nav">
                <ul class="flex flex-col md:flex-row justify-start md:justify-between items-center">
                    <li class="hover:bg-white-100">
                        <a href="<?= url('/verificados') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:text-slate-50 <?= url()->current() == url('/verificados') ? 'text-white' : '';?>">Usuarios Verificados</a>
                    </li>
                    <li class="hover:bg-white-100">
                        <a href="<?= url('/usuarios') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:text-slate-50 <?= url()->current() == url('/usuarios') ? 'text-white' : '';?>">Usuarios</a>
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
                    <li class="hover:bg-white-100">
                        <a href="<?= url('/contacto') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:bg-white-100 hover:text-slate-50 <?= url()->current() == url('/contacto') ? 'text-white' : '';?>">Contacto</a>
                    </li>
                </ul>
                <a id="cerrar-session" href="<?= url('/logout') ;?>" class="px-3 py-2 text-slate-300 rounded-lg hover:bg-white-100 hover:text-slate-50">Cerrar Sesión</a>
            </div>
        </nav>
    </div>
</header>
@endauth
<main class="container mx-auto relative">
    @if(Session::has('message'))
        <div class="mb-10 py-3 {{ Session::get('message_type') ?? 'bg-green-300 text-green-800' }} text-center">{{ Session::get('message') }}</div>
    @endif
    @yield('main')
</main>
<footer class="footer bg-zinc-800 text-center p-10">
    <p class="text-center text-white">Copyright&copy; Unidos {{ now()->year }}</p>
</footer>
<script src="<?= url('js/app.js') ;?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const menu = document.querySelector('#menu');
        menu.addEventListener('click', handleMenu);
    });

    const handleMenu = () => {
        const nav = document.querySelector('#nav');

        if (nav.classList.contains('abrir')) {
            nav.classList.remove('abrir');
        } else {
            nav.classList.add('abrir');
        }
    }
</script>
<script>
    const emails = document.querySelectorAll('li.email');

    if (emails.length > 0) {
        emails.forEach(email => {
            email.addEventListener('click',emailHandler);
        });
    }

    function emailHandler(e) {
        e.target.classList.contains('full') ? e.target.classList.remove('full') : e.target.classList.add('full');
        navigator.clipboard.writeText(e.target.firstElementChild.textContent);

        if (document.querySelector('.clipboard')) {
            return;
        }

        const span = document.createElement('span');
        span.classList.add('clipboard');
        span.innerHTML = 'Email copiado en el portapapeles';
        document.querySelector('main').insertAdjacentElement('beforeend',span);
        span.style.opacity = "1";

        setTimeout(() => {
            span.style.opacity = "0";
            setTimeout(() => {
                span.remove();
            },500)
        },3000);
    }
</script>
@stack('js')
</body>
</html>

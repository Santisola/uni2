<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'UNIDOS - Administrador')</title>
    <link rel="stylesheet" href="<?= url('css/bootstrap.min.css') ;?>">
    <link rel="stylesheet" href="<?= url('css/app.css');?>">
</head>
<body>
@auth
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-celeste">
            <a class="navbar-brand" href="<?= url('/') ;?>">UNIDOS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse justify-content-sm-between" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= url('/usuarios') ;?>" class="nav-link home <?= url()->current() == url('/usuarios') ? 'active' : '';?>">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= url('/noticias') ;?>" class="nav-link home <?= url()->current() == url('/noticias') ? 'active' : '';?>">Noticias</a>
                    </li>
                </ul>
                <a href="<?= url('/logout') ;?>" class="nav-link">Cerrar Sesión</a>
            </div>
        </nav>
    </div>
</header>
@endauth
<main class="container-fluid">
    @if(Session::has('message'))
        <div class="mt-3 alert alert-{{ Session::get('message_type') ?? 'success' }} text-center">{{ Session::get('message') }}</div>
    @endif
    @yield('main')
</main>
<footer class="footer bg-dark text-center text-lg-start p-5">
    <p class="text-center text-light m-0">Copyright&copy; Unidos {{ now()->year }}</p>
</footer>
<script src="<?= url('js/jquery-3.2.1.min.js') ;?>"></script>
<script src="<?= url('js/bootstrap.min.js') ;?>"></script>
@stack('js')
</body>
</html>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>UNIDOS | Recuperar Contraseña</title>
    <link rel="stylesheet" href="<?= url('css/app.css');?>">
    <link rel="stylesheet" href="<?= url('css/estilos.css');?>">
    <link rel="icon" href="{{ asset('/imgs/logo-unidos.png') }}">
    @stack('css')
</head>
<body>
    <header class="bg-violet-800 mb-10 py-3">
        <div class="container">
            <nav class="flex justify-start items-center">
                <a class="text-white text-2xl block md:mr-14" href="<?= url('/') ;?>"><img id="logo" src="{{ asset('imgs/logo.svg') }}" alt="Logo Unidos"></a>
            </nav>
        </div>
    </header>


    <main class="container mx-auto">

        <form method="POST" action="#" class="md:max-w-lg">
            <input type="hidden" name="email" value="{{$_GET['email']}}">
            <input type="hidden" name="token" value="{{$_GET['token']}}">

            <div class="form-group">
                <label for="password1">Ingresá tu Contraseña</label>
                <input type="password" id="password1" name="password1" class="border rounded border-gray-200 w-full py-2 pl-1">
            </div>
            <div class="form-group">
                <label for="password2">Confirmá tu contraseña</label>
                <input type="password" id="password2" name="password2" class="border rounded border-gray-200 w-full py-2 pl-1">
            </div>
            <button class="rounded transition hover:ease-in-out duration-300 mt-5 py-2 px-5 uppercase bg-violet-800 hover:bg-violet-900 text-white">Enviar</button>
        </form>

    </main>


    <footer class="footer bg-zinc-800 text-center p-10">
        <p class="text-center text-white">Copyright&copy; Unidos {{ now()->year }}</p>
    </footer>
    <script src="<?= url('js/app.js') ;?>"></script>
    @stack('js')
</body>
</html>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unidos - Iniciar Sesión</title>
    <link rel="stylesheet" href="<?= url('css/app.css');?>">
    <link rel="stylesheet" href="<?= url('css/animate.css');?>">
    <link rel="stylesheet" href="<?= url('css/owl.carousel.min.css') ;?>">
    <link rel="stylesheet" href="<?= url('css/estilos.css');?>">
    <link rel="icon" href="{{ asset('/imgs/logo-unidos.png') }}">
</head>
<body>
<div id="loguearse">
    <div id="carrousel">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <img src="{{ asset('/imgs/slider-login/login-slide-1.jpg') }}" alt="img1">
            </div>
            <div class="item">
                <img src="{{ asset('/imgs/slider-login/login-slide-2.jpg') }}" alt="img2">
            </div>
            <div class="item">
                <img src="{{ asset('/imgs/slider-login/login-slide-3.jpg') }}" alt="img3">
            </div>
            <div class="item">
                <img src="{{ asset('/imgs/slider-login/login-slide-4.jpg') }}" alt="img4">
            </div>
            <div class="item">
                <img src="{{ asset('/imgs/slider-login/login-slide-5.jpg') }}" alt="img5">
            </div>
        </div>
    </div>
    <div id="login" class="container h-full m-auto flex justify-center items-center flex-col">
        <form action="{{ route('auth.login') }}" method="post" class="mx-auto md:max-w-lg w-full px-5 border rounded md:p-5 border-violeta border-2 shadow-md">
            @if(Session::has('message'))
                <div class="mb-10 py-3 {{ Session::get('message_type') ?? 'bg-green-300 text-green-800' }} text-center">{{ Session::get('message') }}</div>
            @endif
            <h1 class="text-center mb-5 text-3xl texto-violeta font-bold">Iniciar Sesión</h1>
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
                <button type="submit" class="rounded transition hover:ease-in-out duration-300 py-3 uppercase w-full bg-violeta hover:bg-indigo-700 text-white">Ingresar</button>
            </div>
        </form>
    </div>
</div>
<footer class="footer bg-zinc-800 text-center p-10">
    <p class="text-center text-white">Copyright&copy; Unidos {{ now()->year }}</p>
</footer>
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
        mouseDrag: false,
    });
</script>
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
</body>
</html>

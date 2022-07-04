@extends('layouts.main')
@section('title','UNIDOS | Inicio')
@push('css')
    <!-- Link Swiper's CSS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
@endpush
@section('main')
    <h1 class="text-center text-3xl mb-10 text-violet-800 font-bold">UNIDOS</h1>
    <p class="text-lg w-50 mx-auto">
        <b>Unidos</b> trabaja incansablemente para que ellos puedan volver sus hogares o encuentren uno nuevo. Unimos a los rescatistas y sus rescatados con sus futuras familias. Como también unimos a aquellos que se extraviaron con sus dueños.
    </p>
    <section id="ellos">
        <h2 class="text-center text-xl mb-10 text-violet-800 font-bold">Es por ellos</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/7210487/pexels-photo-7210487.jpeg" alt="img1">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/6001779/pexels-photo-6001779.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img2">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/9313627/pexels-photo-9313627.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img3">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/9313636/pexels-photo-9313636.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img4">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/9505960/pexels-photo-9505960.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img5">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/9985929/pexels-photo-9985929.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img6">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/8498519/pexels-photo-8498519.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img7">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/8146755/pexels-photo-8146755.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img8">
                </div>
                <div class="swiper-slide">
                    <img src="https://images.pexels.com/photos/10117271/pexels-photo-10117271.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="img9">
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        const swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            effect: "fade",
            centeredSlides: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
    <script>
        const imgs = document.querySelectorAll('#ellos img');

        imgs.forEach(img => {
            console.log(img.parentElement)
           img.parentElement.style.backgroundImage = `url(${img.src})`;
        });
    </script>
@endpush

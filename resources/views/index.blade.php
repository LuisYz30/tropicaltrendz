@extends('layouts.app')

@section('content')
<!--Seccion del video-->
<div class="container-fluid p-0 style-banner position-relative">
    <video autoplay muted loop playsinline class="banner-video scroll-fade">
        <source src="{{asset('images/Video/video_baner.mp4')}}" type="video/mp4">
    </video>
    <div class="banner-content position-absolute d-flex flex-column align-items-center align-items-md-start text-center text-md-start p-3">
        <h1 class="brand-name fs-sm-1 ">TROPICAL TRENDZ</h1>
        <p class="collection-subtitle  fs-md-3">COLECCIÓN VERANO 2025</p>
        <a href="#" id="scroll-to-carrusel"  class="btn-azul-oscuro text-decoration-none mt-3 ">COMPRAR AHORA</a>
    </div>
</div>

<div class="container py-5 bloque-carrusel" id="seccion-carrusel">
    <div class="carrusel-temporada text-center mb-2">
    <h1>COLECCIÓN DE VERANO</h1>
    </div>
<div class="carrusel-fondo">
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
         @forelse($productos as $producto)
        <div class="swiper-slide">
            @include('components.carruselCards', ['producto' => $producto])
        </div>
        @empty
            <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                <p class="fs-4 fw-semibold text-center text-muted">No hay productos disponibles.</p>
            </div>
        @endforelse
    </div>

    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
</div>
</div>


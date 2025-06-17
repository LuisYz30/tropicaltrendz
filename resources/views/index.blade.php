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


<div id="seccion-carrusel">
<div class="container py-5 bloque-carrusel" >
    <div class="carrusel-temporada text-center" data-aos="fade-up">
    <h1>COLECCIÓN DE VERANO</h1>
    </div>
<div class="carrusel-fondo"  data-aos="fade-up">
<div class="swiper mySwiper"  data-aos="fade-up">
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
</div>

  <section class="container py-5">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="icon-card text-center p-1">
        <div class="icon-img mb-1">
          <img src="{{ asset('images/IconosRopa/i1.svg') }}" alt="Confort y estilo" width="65" height="65">
        </div>
        <div class="icon-txt">
          <h3>Confort y estilo</h3>
          <p>Prendas diseñadas para lucir bien y sentirse aún mejor</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="icon-card text-center p-1">
        <div class="icon-img mb-1">
          <img src="{{ asset('images/IconosRopa/i2.svg') }}" alt="Cuidado ácil" width="65" height="65">
        </div>
        <div class="icon-txt">
          <h3>Cuidado fácil</h3>
          <p>Lavado sencillo sin perder la forma ni el color</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="icon-card text-center p-1">
        <div class="icon-img mb-1">
          <img src="{{ asset('images/IconosRopa/i3.svg') }}" alt="Resistencia y flexibilidad" width="65" height="65">
        </div>
        <div class="icon-txt">
          <h3>Resistencia y flexibilidad</h3>
          <p>Telas que se adaptan al cuerpo, brindando libertad de movimiento y mayor durabilidad</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Sección de Galería -->
<div class="gallery-fondo">
<section class="gallery-section" >
    <div class="gallery" data-aos="zoom-out-up"">
        <img src="{{ asset('images/Mujer/fm1.png') }}" alt="Traje de baño mujer 1">
        <img src="{{ asset('images/Mujer/fm2.png') }}" alt="Traje de baño mujer 2">
        <img src="{{ asset('images/Mujer/fm3.png') }}" alt="Traje de baño mujer 3">
        <img src="{{ asset('images/Hombre/fh1.png') }}" alt="Traje de baño hombre 1">
        <img src="{{ asset('images/Hombre/fh2.png') }}" alt="Traje de baño hombre 2">
        <img src="{{ asset('images/Hombre/fh2.png') }}" alt="Traje de baño hombre 3">
        <img src="{{ asset('images/Niños/fñ1.webp') }}" alt="Traje de baño niña 1">
        <img src="{{ asset('images/Niños/fñ2.webp') }}" alt="Traje de baño niño 2">
    </div>

    <div class="info-texto">
        <h2>Descubre la Esencia del Verano</h2>
        <p >En <strong>Tropical Trendz</strong> te traemos los trajes de baño más vibrantes, frescos y únicos para que vivas tu verano con estilo. Disfruta de diseños modernos para toda la familia, hechos para destacar bajo el sol. ¡Sumérgete en la moda tropical!</p>
    </div>
</section>
</div>

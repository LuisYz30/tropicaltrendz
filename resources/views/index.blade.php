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
        <a href="#" class="btn-azul-oscuro text-decoration-none mt-3 ">COMPRAR AHORA</a>
    </div>
</div>
@endsection
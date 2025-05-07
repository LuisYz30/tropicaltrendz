@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center mt-9 mb-10">
        <h1 class="fw-bold text-uppercase mb-4 display-3">TRAJES DE BAÑO PARA MUJER</h1>
    </div>
    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 product-card">
                    <img src="{{ asset('images/mujer/' . $producto->imagen) }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text text-primary fw-bold">{{ $producto->precio_formateado }}</p>
                        <a href="{{ route('producto.detalle', $producto->idproducto) }}" class="btn btn-outline-primary ver-producto">Ver producto</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles.</p>
        @endforelse
    </div>
</div>
@endsection

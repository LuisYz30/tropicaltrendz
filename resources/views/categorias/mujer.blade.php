@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Productos para Mujer</h2>
    <div class="row">
        @forelse($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/mujer/' . $producto->imagen) }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre }}</h5>
                        <p class="card-text">{{ $producto->descripcion }}</p>
                        <p class="card-text text-primary fw-bold">{{ $producto->precio_formateado }}</p>
                        <a href="#" class="btn btn-outline-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay productos disponibles.</p>
        @endforelse
    </div>
</div>
@endsection

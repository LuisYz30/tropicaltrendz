@extends('layouts.app')
@section('content')
<div class="container-fluid mt-4">
    <div class="text-center mt-9 mb-5">
        <h1 class="fw-bold text-uppercase display-3">TRAJES DE BAÑO PARA MUJER</h1>
    </div>
    <div class="row">
        <!-- Filtro alineado a la izquierda -->
        <div class="col-md-2 mb-4">
            <div class="bg-dark text-white p-3 rounded">
                <h5 class="mb-3">Filtrar por</h5>
                <h6 class="mb-2">Precio</h6>
                <form method="GET" action="{{ route('hombre') }}">
                    <input type="range" class="form-range" min="10000" max="100000" step="10000"
                           name="precio_min" id="precio_min_range"
                           value="{{ request('precio_min', 10000) }}"
                           oninput="updatePriceLabels()">
                    <input type="range" class="form-range mt-2" min="10000" max="100000" step="10000"
                           name="precio_max" id="precio_max_range"
                           value="{{ request('precio_max', 100000) }}"
                           oninput="updatePriceLabels()">
                    <div class="d-flex justify-content-between mt-2">
                        <small id="precio_min_label">10000 COP</small>
                        <small id="precio_max_label">100000 COP</small>
                    </div>
                    <button type="submit" class="btn btn-outline-light btn-sm mt-3 w-100">Aplicar filtro</button>
                </form>
            </div>
        </div>
       <!-- Sección de productos -->
       <div class="col-md-10">
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
            <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                <p class="fs-4 fw-semibold text-center text-muted">No hay productos disponibles.</p>
            </div>
        @endforelse
    </div>
</div>
<script>
    function updatePriceLabels() {
        const min = document.getElementById('precio_min_range').value;
        const max = document.getElementById('precio_max_range').value;
    
        document.getElementById('precio_min_label').innerText = min + ' COP';
        document.getElementById('precio_max_label').innerText = max + ' COP';
    }
    document.addEventListener('DOMContentLoaded', updatePriceLabels);
    </script>
@endsection
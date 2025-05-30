@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="text-center mt-9 mb-5">
        <h1 class="fw-bold text-uppercase display-3">TRAJES DE BAÑO PARA NIÑOS</h1>
    </div>
    <div class="row-wrapper">
    <div class="row gx-5">
        <!-- Filtro -->
        <div class="col-md-3 mb-4">
            <div class="filtro-card">
                <h5 class="filtro-titulo">Filtrar por</h5>
                <h6 class="filtro-subtitulo">Precio</h6>

                <form method="GET" action="{{ route('niños') }}">
                    <input type="range" class="filtro-range" min="10000" max="100000" step="10000"
                           name="precio_min" id="precio_min_range"
                           value="{{ request('precio_min', 10000) }}"
                           oninput="updatePriceLabels()">

                    <input type="range" class="filtro-range mt-2" min="10000" max="100000" step="10000"
                           name="precio_max" id="precio_max_range"
                           value="{{ request('precio_max', 100000) }}"
                           oninput="updatePriceLabels()">

                    <div class="filtro-labels">
                        <small id="precio_min_label">10000 COP</small>
                        <small id="precio_max_label">100000 COP</small>
                    </div>

                    <button type="submit" class="btn btn-filtro mt-3 w-100">Aplicar filtro</button>
                </form>
            </div>
        </div>

        <!-- Productos -->
        <div class="col-md-9">
            <div class="row">
                @forelse($productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-card">
                            <img src="{{ asset('storage/' . $producto->imagen) }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text">{{ $producto->descripcion }}</p>
                                <p class="card-text text-primary fw-bold">{{ $producto->precio_formateado }}</p>
                                <a href="{{ route('producto.detalle', $producto->idproducto) }}" class="btn btn-outline-primary ver-producto">Ver producto</a>
                                @auth
                                @if(auth()->user()->rol == 'admin')
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('productos.edit', $producto->idproducto) }}" class="btn btn-primary boton-editar">Editar</a>
                                        <form action="{{ route('productos.destroy', $producto->idproducto) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar este producto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary boton-eliminar">Eliminar</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth     
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
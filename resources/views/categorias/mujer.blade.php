@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <div class="text-center mt-5 mb-4">
        <h1 class="fw-bold text-uppercase display-3">TRAJES DE BAÑO PARA MUJER</h1>
    </div>

    <!-- Botón Filtrar -->
    <div class="d-flex justify-content-end mb-3"> 
        <button class="btn-azul-oscuro d-flex align-items-center gap-2 me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#filtroOffcanvas" aria-controls="filtroOffcanvas">
            <i class="bi bi-funnel-fill"></i> Filtrar
        </button>
    </div>

    <!-- Filtro lateral -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="filtroOffcanvas" aria-labelledby="filtroOffcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="filtroOffcanvasLabel">Filtrar por</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
        </div>
        <div class="offcanvas-body">
            <h6 class="filtro-subtitulo">Precio</h6>
            <form method="GET" action="{{ route('hombre') }}">
                <input type="range" class="form-range" min="10000" max="100000" step="10000"
                    name="precio_min" id="precio_min_range"
                    value="{{ request('precio_min', 10000) }}"
                    oninput="updatePriceLabels()">

                <input type="range" class="form-range mt-2" min="10000" max="100000" step="10000"
                    name="precio_max" id="precio_max_range"
                    value="{{ request('precio_max', 100000) }}"
                    oninput="updatePriceLabels()">

                <div class="d-flex justify-content-between">
                    <small id="precio_min_label">10000 COP</small>
                    <small id="precio_max_label">100000 COP</small>
                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Aplicar filtro</button>
            </form>
        </div>
    </div>

    <!-- Productos -->
    <div class="container py-4">
    <div class="row g-4 justify-content-center">
        @forelse($productos as $producto)
            @include('components.cards', ['producto' => $producto])
        @empty
            <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                <p class="fs-4 fw-semibold text-center text-muted">No hay productos disponibles.</p>
            </div>
        @endforelse
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

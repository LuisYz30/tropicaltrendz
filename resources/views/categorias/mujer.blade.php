@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="text-center mt-9 mb-5">
        <h1 class="fw-bold text-uppercase display-3">TRAJES DE BAÑO PARA MUJER</h1>
    </div>
    <div class="row-wrapper">
    <div class="row gx-5">
        <!-- Filtro -->
        <div class="col-md-3 mb-4">
            <div class="filtro-card">
                <h5 class="filtro-titulo">Filtrar por</h5>
                <h6 class="filtro-subtitulo">Precio</h6>

                <form method="GET" action="{{ route('mujer') }}">
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
            <div class="row g-4">
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

@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Menú lateral -->
    <div class="informes-sidebar d-flex flex-column p-3">
        <h1 class="text-center mb-4">Panel</h1>
        <button id="btnHistorial" class="informes-boton btn mb-3" onclick="window.location.href='?seccion=ventas'">Ventas realizadas</button>
        <button id="btnGrafico" class="informes-boton btn mb-3">Gráfico</button>
        <button id="btnInventario" class="informes-boton btn" onclick="window.location.href='?seccion=inventario'">Inventario</button>
    </div>

    <!-- Contenido principal -->
    <div class="flex-grow-1 p-4">
        <!-- Historial -->
        <div id="historialSection">
            <h1 class="informes-titulo mb-3">Ventas realizadas</h1>
            <table class="table informes-tabla table-bordered">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Teléfono</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Método Pago</th>
                        <th>Detalles</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                        <tr>
                            <td>{{ $compra->name }}</td>
                            <td>{{ $compra->telefono }}</td>
                            <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d-m-Y') }}</td>
                            <td>${{ number_format($compra->total, 0, ',', '.') }}</td>
                            <td>{{ $compra->metodo_pago }}</td>
                            <td>
                                <button class="btn-verdetalle" data-bs-toggle="modal" data-bs-target="#modalDetalles" data-factura-id="{{ $compra->id }}">
                                    Ver detalles
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $compras->links('pagination::bootstrap-5') }}

            <!-- Modal de detalles -->
            <div class="modal fade" id="modalDetalles" tabindex="-1" aria-labelledby="modalDetallesLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalDetallesLabel">Detalles de la Compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                  </div>
                  <div class="modal-body">
                    <div id="detallesCompra"></div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <!-- Gráfico -->
<div id="graficoSection" style="display:none;">
    <h3 class="informes-titulo">Productos más vendidos</h3>
    <div style="width: 1250px; height: 400px;">
        <canvas id="ventasChart"></canvas>
    </div>
</div>

        <!-- Inventario -->
        <div id="inventarioSection" style="display:none;">
            <h3 class="informes-titulo">Inventario</h3>

            <div class="mb-3">
                <form method="GET" id="formFiltroInventario">
                    <input type="hidden" name="seccion" value="inventario">
                    <label for="filtroCategoria" class="form-label">Filtrar por categoría</label>
                    <select id="filtroCategoria" name="categoria" class="form-select" onchange="document.getElementById('formFiltroInventario').submit()">
                        <option value="">Todas</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->idcategoria }}" {{ request('categoria') == $categoria->idcategoria ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <table class="table informes-tabla table-bordered">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Stock por talla</th>
                    </tr>
                </thead>
                <tbody id="inventarioTableBody">
                    @foreach ($inventario as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->categoria->nombre }}</td>
                            <td>
                                {{ $item->tallas->map(fn($t) => $t->nombre . ': ' . $t->pivot->stock)->implode(' , ') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $inventario->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico de ventas
    const ctx = document.getElementById('ventasChart').getContext('2d');
    const ventasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($ventasPorProducto->pluck('nombre_producto')->toArray()) !!},
            datasets: [{
                label: 'Productos más vendidos',
                data: {!! json_encode($ventasPorProducto->pluck('total_vendido')->toArray()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
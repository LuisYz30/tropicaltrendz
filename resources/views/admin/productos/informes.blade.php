@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Menú lateral -->
    <div class="flex-column p-2 bg-light" style="width: 150px; height: 100vh;">
        <button id="btnHistorial" class="btn btn-outline-primary mb-2 w-100">Ventas realizadas</button>
        <button id="btnGrafico" class="btn btn-outline-primary mb-2 w-100">Gráfico</button>
        <button id="btnInventario" class="btn btn-outline-primary w-100">Inventario</button>
    </div>

    <!-- Contenido principal -->
    <div class="flex-grow-1 p-3">
        <!-- Historial -->
        <div id="historialSection">
            <h2>Ventas realizadas</h2>
            <table class="table">
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
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetalles" data-factura-id="{{ $compra->id }}">
                                    Ver detalles
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $compras->links() }}

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
            <h2>Productos más vendidos</h2>
            <canvas id="ventasChart" width="400" height="200"></canvas>
        </div>

        <!-- Inventario -->
        <div id="inventarioSection" style="display:none;">
            <h2>Inventario</h2>

            <div class="mb-3">
                <label for="filtroCategoria" class="form-label">Filtrar por categoría</label>
                <select id="filtroCategoria" class="form-select" onchange="filtrarInventario()">
                    <option value="">Todas</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->idcategoria }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Stock por talla</th>
                    </tr>
                </thead>
                <tbody id="inventarioTableBody">
                    @foreach ($inventario as $item)
                        <tr data-categoria="{{ $item->idcategoria }}">
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->categoria->nombre }}</td>
                            <td>
                                @foreach ($item->tallas as $talla)
                                    {{ $talla->nombre }}: {{ $talla->pivot->stock }}<br>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>{{ $inventario->links() }}
        </div>
    </div>
</div>

<script>
    // Gráfico de ventas
    const ctx = document.getElementById('ventasChart').getContext('2d');
    const ventasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($ventasPorProducto->pluck('nombre')->toArray()) !!},
            datasets: [{
                label: 'Productos más vendidos',
                data: {!! json_encode($ventasPorProducto->pluck('total_vendido')->toArray()) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection

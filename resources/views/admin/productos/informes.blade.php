@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Menú lateral -->
    <div class="flex-column p-2 bg-light" style="width: 150px; height: 100vh;">
        <button id="btnHistorial" class="btn btn-outline-primary mb-2 w-100">Ventas realizadas</button>
        <button id="btnGrafico" class="btn btn-outline-primary w-100">Gráfico</button>
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
                            <td>{{ $compra->fecha }}</td>
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
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Botones
    const btnHistorial = document.getElementById('btnHistorial');
    const btnGrafico = document.getElementById('btnGrafico');

    // Secciones
    const historialSection = document.getElementById('historialSection');
    const graficoSection = document.getElementById('graficoSection');

    btnHistorial.addEventListener('click', () => {
        historialSection.style.display = 'block';
        graficoSection.style.display = 'none';
    });

    btnGrafico.addEventListener('click', () => {
        historialSection.style.display = 'none';
        graficoSection.style.display = 'block';
        ventasChart.resize();
    });

    // Modal detalles
    var modal = document.getElementById('modalDetalles');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var facturaId = button.getAttribute('data-factura-id');
        var modalBody = modal.querySelector('#detallesCompra');

        fetch('/admin/informes/detalles/' + facturaId)
            .then(response => response.json())
            .then(data => {
                let html = '<table class="table">';
                html += '<thead><tr><th>Producto</th><th>Talla</th><th>Precio Unitario</th><th>Cantidad</th></tr></thead><tbody>';
                data.forEach(item => {
                    html += `<tr>
                                <td>${item.nombre}</td>
                                <td>${item.talla}</td>
                                <td>$${item.precio_unitario.toFixed(0)}</td>
                                <td>${item.cantidad}</td>
                            </tr>`;
                });
                html += '</tbody></table>';
                modalBody.innerHTML = html;
            })
            .catch(error => {
                modalBody.innerHTML = '<p>Error cargando detalles.</p>';
            });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ventasChart').getContext('2d');
    const ventasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($ventasPorProducto->pluck('nombre')) !!},
            datasets: [{
                label: 'Productos más vendidos',
                data: {!! json_encode($ventasPorProducto->pluck('total_vendido')) !!},
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

// Mostrar sección según query string al cargar
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
        const seccion = urlParams.get('seccion');

        toggleSection(seccion === 'inventario' ? 'inventarioSection' : (seccion === 'grafico' ? 'graficoSection' : 'historialSection'));
    });

    // Botones
    const btnHistorial = document.getElementById('btnHistorial');
    const btnGrafico = document.getElementById('btnGrafico');
    const btnInventario = document.getElementById('btnInventario');

    btnHistorial.addEventListener('click', () => {
        window.location.href = '?seccion=ventas';
    });

    btnGrafico.addEventListener('click', () => {
        window.location.href = '?seccion=grafico';
    });

    btnInventario.addEventListener('click', () => {
        window.location.href = '?seccion=inventario';
    });

    function toggleSection(sectionId) {
        document.getElementById('historialSection').style.display = 'none';
        document.getElementById('graficoSection').style.display = 'none';
        document.getElementById('inventarioSection').style.display = 'none';
        document.getElementById(sectionId).style.display = 'block';
        if (sectionId === 'graficoSection') {
            ventasChart.resize();
        }
    }

    // Modal detalles
    document.querySelectorAll('[data-factura-id]').forEach(button => {
        button.addEventListener('click', function() {
            const facturaId = this.getAttribute('data-factura-id');
            const modalBody = document.querySelector('#detallesCompra');

            modalBody.innerHTML = '<p>Cargando...</p>';

            fetch(`/informes/detalles/${facturaId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        modalBody.innerHTML = '<p>No hay detalles para esta factura.</p>';
                        return;
                    }
                    let html = '<table class="table table-bordered">';
                    html += '<thead><tr><th>Producto</th><th>Categoría</th><th>Talla</th><th>Precio Unitario</th><th>Cantidad</th></tr></thead><tbody>';
                    data.forEach(item => {
                        html += `
                            <tr>
                                <td>${item.producto}</td>
                                <td>${item.categoria}</td>
                                <td>${item.talla}</td>
                                <td>$${parseFloat(item.precio_unitario).toLocaleString()}</td>
                                <td>${item.cantidad}</td>
                            </tr>`;
                    });
                    html += '</tbody></table>';
                    modalBody.innerHTML = html;
                })
                .catch(() => {
                    modalBody.innerHTML = '<p>Error cargando detalles.</p>';
                });
        });
    });

    // Filtro de inventario
   function filtrarInventario() {
    document.getElementById('formFiltroInventario').submit();
}
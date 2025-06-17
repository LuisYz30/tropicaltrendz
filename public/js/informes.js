
    // Botones
    const btnHistorial = document.getElementById('btnHistorial');
    const btnGrafico = document.getElementById('btnGrafico');

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
                            <td>${item.nombre}</td>
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

//inventario
document.getElementById('btnHistorial').addEventListener('click', () => {
        toggleSection('historialSection');
    });
    document.getElementById('btnGrafico').addEventListener('click', () => {
        toggleSection('graficoSection');
    });
    document.getElementById('btnInventario').addEventListener('click', () => {
        toggleSection('inventarioSection');
    });

    function toggleSection(sectionId) {
        document.getElementById('historialSection').style.display = 'none';
        document.getElementById('graficoSection').style.display = 'none';
        document.getElementById('inventarioSection').style.display = 'none';
        document.getElementById(sectionId).style.display = 'block';
    }

    function filtrarInventario() {
        const categoriaId = document.getElementById('filtroCategoria').value;
        const filas = document.querySelectorAll('#inventarioTableBody tr');

        filas.forEach(fila => {
            if (!categoriaId || fila.dataset.categoria === categoriaId) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }

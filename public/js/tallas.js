document.addEventListener('DOMContentLoaded', function () {
    const categoriasSelect = document.querySelector('select[name="idcategoria"]');
    const tallasContainer = document.getElementById('tallas-container');

    const tallasPorSeccion = {
        'niños': ['8', '10', '12', '14'],
        'adultos': ['S', 'M', 'L', 'XL']
    };

    const tallasDB = window.tallasDB || {};
    const productoTallas = window.productoTallas || {};
    const categoriaInicial = window.categoriaInicial || '';

    function cargarTallas(nombreCategoria) {
        const selected = nombreCategoria.toLowerCase();
        let tallasMostrar = tallasPorSeccion.adultos;

        if (selected.includes('niño')) {
            tallasMostrar = tallasPorSeccion.niños;
        }

        tallasContainer.innerHTML = '';

        tallasMostrar.forEach(tallaNombre => {
            const idtalla = tallasDB[tallaNombre] || '';
            const stock = productoTallas[idtalla] !== undefined ? productoTallas[idtalla] : 0;
            const checked = productoTallas[idtalla] !== undefined ? 'checked' : '';

            const item = document.createElement('div');
            item.classList.add('talla-item');

            item.innerHTML = `
                <label class="talla-label">
                    <input type="checkbox" name="tallas[]" value="${idtalla}" ${checked}>
                    ${tallaNombre}
                </label>
                <input type="number" name="stock_tallas[${idtalla}]" class="stock-input" min="0" value="${stock}" required>
            `;

            tallasContainer.appendChild(item);
        });
    }

    // Cuando el usuario cambia la categoría (create y edit)
    categoriasSelect.addEventListener('change', function () {
        const selectedText = categoriasSelect.options[categoriasSelect.selectedIndex].text;
        cargarTallas(selectedText);
    });

    // Solo para modo edición (cuando ya hay una categoría seleccionada)
    if (categoriaInicial) {
        cargarTallas(categoriaInicial);
    }
});
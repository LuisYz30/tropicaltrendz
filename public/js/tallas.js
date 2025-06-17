document.addEventListener('DOMContentLoaded', function() {
    const categoriasSelect = document.querySelector('select[name="idcategoria"]');
    const tallasContainer = document.getElementById('tallas-container');

    // Define las tallas por sección
    const tallasPorSeccion = {
        'niños': ['12', '14', '16', '18'],
        'adultos': ['S', 'M', 'L', 'XL']
    };

    // Mapeo generado dinámicamente (se inyecta desde Blade en un <script> en la vista)
    const tallasDB = window.tallasDB || {};

    categoriasSelect.addEventListener('change', function() {
        const selected = categoriasSelect.options[categoriasSelect.selectedIndex].text.toLowerCase();

        let tallasMostrar = tallasPorSeccion.adultos; // por defecto
        if (selected.includes('niño')) {
            tallasMostrar = tallasPorSeccion.niños;
        }

        tallasContainer.innerHTML = '';

        tallasMostrar.forEach(tallaNombre => {
            const idtalla = tallasDB[tallaNombre] || '';

            const item = document.createElement('div');
            item.classList.add('talla-item');

            item.innerHTML = `
                <label class="talla-label">
                    <input type="checkbox" name="tallas[]" value="${idtalla}">
                    ${tallaNombre}
                </label>
                <input type="number" name="stock_tallas[${idtalla}]" class="stock-input" min="0" value="0" required>
            `;

            tallasContainer.appendChild(item);
        });
    });
});

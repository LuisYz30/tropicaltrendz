document.addEventListener('DOMContentLoaded', function () {
    const tallaSelect = document.getElementById('talla');
    const cantidadInput = document.getElementById('cantidad');
    const stockInfo = document.getElementById('stock-info');

    function actualizarStockInfo() {
        const selectedOption = tallaSelect.options[tallaSelect.selectedIndex];
        const stock = selectedOption.dataset.stock;

        if (stock) {
            stockInfo.textContent = `Stock disponible: ${stock} unidad${stock == 1 ? '' : 'es'}`;
            cantidadInput.max = stock;
        } else {
            stockInfo.textContent = 'Selecciona una talla para ver el stock.';
            cantidadInput.removeAttribute('max');
        }
    }

    // Inicializar stock al cargar la página
    actualizarStockInfo();

    tallaSelect.addEventListener('change', actualizarStockInfo);

    cantidadInput.addEventListener('input', function () {
        const selectedOption = tallaSelect.options[tallaSelect.selectedIndex];
        const stock = parseInt(selectedOption.dataset.stock);

        if (parseInt(this.value) > stock) {
            alert(`Solo hay ${stock} unidad${stock === 1 ? '' : 'es'} disponibles para esta talla.`);
            this.value = stock;
        }
    });
});

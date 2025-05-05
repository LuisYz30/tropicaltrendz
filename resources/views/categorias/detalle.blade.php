<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $producto->nombre }}</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .contenedor { display: flex; gap: 40px; }
        .imagen img { max-width: 300px; border-radius: 10px; }
        .info { max-width: 400px; }
        .precio { font-size: 24px; color: green; }
        select, button { margin-top: 10px; padding: 8px; width: 100%; }
    </style>
</head>
<body>
    <h1>{{ $producto->nombre }}</h1>
    <div class="contenedor">
        <div class="imagen">
            <img src="{{ asset('images/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
        </div>
        <div class="info">
            <p>{{ $producto->descripcion }}</p>
            <p class="precio">{{ $producto->precioFormateado }}</p>

            <form method="POST" action="{{ route('carrito.agregar') }}">
                @csrf
                <input type="hidden" name="idproducto" value="{{ $producto->idproducto }}">
                
                <label for="talla">Selecciona una talla:</label>
                <select name="talla" id="talla" required>
                    @foreach ($tallas as $talla)
                        <option value="{{ $talla->idtalla }}">{{ $talla->nombre }}</option>
                    @endforeach
                </select>
                
                <button type="submit">Agregar al carrito</button>
            </form>
        </div>
    </div>
</body>
</html>

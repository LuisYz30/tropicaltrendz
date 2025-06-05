
    <div class="carrusel-card">
        <img src="{{ asset('storage/' . $producto->imagen) }}" class="mt-2 mb-2">
            <h5>{{ $producto->nombre }}</h5>
            <p>{{ $producto->descripcion }}</p>
            <p class="text-primary fw-bold fs-6">{{ $producto->precio_formateado }}</p>
            <a href="{{ route('producto.detalle', $producto->idproducto) }}" class="ver-producto">Ver producto</a>

            @auth
            @if(auth()->user()->rol == 'admin')
                <div class="d-flex gap-2 mt-1 justify-content-center">
                    <a href="{{ route('productos.edit', $producto->idproducto) }}" class="btn btn-primary boton-editar">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->idproducto) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar este producto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary boton-eliminar">Eliminar</button>
                    </form>
                </div>
            @endif
            @endauth
    </div>


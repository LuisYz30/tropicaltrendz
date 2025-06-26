
    <div class="carrusel-card">
        <img src="{{ asset('storage/' . $producto->imagen) }}" class="mt-2">
            <h5>{{ $producto->nombre }}</h5>
            <p>{{ $producto->descripcion }}</p>
            <p class="text-primary fw-bold fs-6">{{ $producto->precio_formateado }}</p>
            <a href="{{ route('producto.detalle', $producto->idproducto) }}" class="ver-producto">Ver producto</a>

            @auth
            @if(auth()->user()->rol == 'admin')
                <div class="d-flex justify-content-center gap-1">
                    <a href="{{ route('productos.edit', $producto->idproducto) }}" class="btn btn-primary boton-editar mt-2">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->idproducto) }}" method="POST"  class="form-eliminar">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary boton-eliminar mt-2">Eliminar</button>
                    </form>
                </div>
            @endif
            @endauth
    </div>


<div class="col-11 col-sm-6 col-lg-3 mb-4 d-flex producto-item">
    <div class="card product-card w-100">
        <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-producto" alt="{{ $producto->nombre }}">
        
        <div class="card-body">
            <h5>{{ $producto->nombre }}</h5>
            <p>{{ $producto->descripcion }}</p>
            <p class="text-primary fw-bold fs-5">{{ $producto->precio_formateado }}</p>
            <a href="{{ route('producto.detalle', $producto->idproducto) }}" class="ver-producto mt-1">Ver producto</a>

           @auth
            @if(auth()->user()->rol == 'admin')
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('productos.edit', $producto->idproducto) }}" class="btn btn-primary boton-editar">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->idproducto) }}" method="POST"  class="form-eliminar">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary boton-eliminar">Eliminar</button>
                    </form>
                </div>
            @endif
            @endauth
        </div>
    </div>
</div>

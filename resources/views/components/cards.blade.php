                @forelse($productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product-card">
                            <img src="{{ asset('storage/' . $producto->imagen) }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nombre }}</h5>
                                <p class="card-text">{{ $producto->descripcion }}</p>
                                <p class="card-text text-primary fw-bold">{{ $producto->precio_formateado }}</p>
                                <a href="{{ route('producto.detalle', $producto->idproducto) }}" class="btn btn-outline-primary ver-producto mb-2">Ver producto</a>

                                @auth
                                    @if(auth()->user()->rol == 'admin')
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('productos.edit', $producto->idproducto) }}" class="btn btn-primary boton-editar">Editar</a>
                                            <form action="{{ route('productos.destroy', $producto->idproducto) }}" method="POST" class="form-eliminar d-inline">
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
                @empty
                    <p>No hay productos disponibles.</p>
                @endforelse

@extends('layouts.app')

@section('content')
<div class="container producto-form">
    <h2>Editar Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups! Algo salió mal:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="formulario-producto" action="{{ route('productos.update', $producto->idproducto) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="seccion" value="{{ $producto->categoria->nombre }}">    
    @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $producto->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $producto->precio) }}" required>
        </div>

        <div class="mb-3">
            <label>Categoría</label>
            <select name="idcategoria" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->idcategoria }}" 
                        {{ old('idcategoria', $producto->idcategoria) == $categoria->idcategoria ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Imagen Actual</label><br>
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" width="100" alt="Imagen actual"><br><br>
            @endif
            <label>Nueva Imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label class="form-label">Tallas y stock por talla:</label>
            <div class="tallas-grid">
                @php
                    $productoTallas = $producto->tallas->keyBy('idtalla');
                @endphp
                @foreach ($tallas as $talla)
                    @php
                        $checked = old('tallas') 
                            ? in_array($talla->idtalla, old('tallas')) 
                            : $productoTallas->has($talla->idtalla);
        
                        $stockValue = old('stock_tallas.' . $talla->idtalla)
                            ?? ($productoTallas->has($talla->idtalla) ? $productoTallas[$talla->idtalla]->pivot->stock : 0);
                    @endphp
                    <div class="talla-item">
                        <label class="talla-label">
                            <input type="checkbox" name="tallas[]" value="{{ $talla->idtalla }}" id="talla-{{ $talla->idtalla }}" {{ $checked ? 'checked' : '' }}>
                            {{ $talla->nombre }}
                        </label>
                        <input type="number" name="stock_tallas[{{ $talla->idtalla }}]" class="stock-input" min="0" value="{{ $stockValue }}" required>
                    </div>
                @endforeach
            </div>
        </div>
        

        <button class="boton-actualizar">Actualizar</button>
        <a href="{{ url()->previous() }}" class="boton-cancelar">Cancelar</a>
    </form>
</div>
@endsection

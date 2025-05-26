@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>

    <form action="{{ route('productos.update', $producto->idproducto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required>{{ $producto->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="{{ $producto->precio }}" required>
        </div>

        <div class="mb-3">
            <label>Categoría</label>
            <select name="idcategoria" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @if($producto->idcategoria == $categoria->id) selected @endif>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Imagen Actual</label><br>
            <img src="{{ asset('storage/' . $producto->imagen) }}" width="100"><br><br>
            <label>Nueva Imagen (opcional)</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
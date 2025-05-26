@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Agregar Producto</h2>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Categoría</label>
            <select name="idcategoria" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Imagen</label>
            <input type="file" name="imagen" class="form-control" required>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td>{{ $producto->precioFormateado }}</td>
                <td><img src="{{ asset('storage/' . $producto->imagen) }}" width="80"></td>
                <td>
                    <a href="{{ route('productos.edit', $producto->idproducto) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->idproducto) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro de eliminar este producto?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
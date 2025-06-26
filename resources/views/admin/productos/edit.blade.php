@extends('layouts.app')

@section('content')
<div class="container producto-form">
    <h1>Editar Producto</h1>

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
        @csrf
        @method('PUT')

        {{-- Campo oculto que se actualiza dinámicamente --}}
        <input type="hidden" name="seccion" id="seccion" value="{{ strtolower($producto->categoria->nombre) }}">

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
            <select name="idcategoria" class="form-control" id="idcategoria" required>
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
            <label>Actualizar Imagen</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>

        {{-- Tallas cargadas dinámicamente por JS --}}
        <div class="form-group">
            <label class="form-label">Tallas y stock por talla:</label>
            <div id="tallas-container" class="tallas-grid">
                {{-- Este contenedor se llena dinámicamente con JS --}}
            </div>
        </div>

        <button class="boton-actualizar">Actualizar</button>
        <a href="{{ url()->previous() }}" class="boton-cancelar">Cancelar</a>
    </form>
</div>

{{-- Script para actualizar el campo oculto "seccion" --}}
<script>
    const categoriaSelect = document.getElementById('idcategoria');
    const seccionInput = document.getElementById('seccion');

    categoriaSelect.addEventListener('change', function () {
        const selectedText = this.options[this.selectedIndex].text;
        seccionInput.value = selectedText.toLowerCase();
    });
</script>

{{-- Variables necesarias para que tallas.js funcione --}}
<script>
    window.tallasDB = @json($tallas->pluck('idtalla', 'nombre'));
    window.productoTallas = @json($producto->tallas->pluck('pivot.stock', 'idtalla'));
    window.categoriaInicial = "{{ $producto->categoria->nombre }}";
</script>
<script src="{{ asset('js/tallas.js') }}"></script>
@endsection
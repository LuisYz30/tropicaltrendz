@extends('layouts.app')

@section('content')
<div class="container producto-form">
    <h1 class="mb-4">Agregar nuevo producto</h1>

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

    <form class="formulario-producto" action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre del producto:</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="4" required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="precio">Precio (COP):</label>
            <input type="number" name="precio" class="form-control" step="0.01" value="{{ old('precio') }}" required>
        </div>

        <div class="form-group">
            <label for="idcategoria">Categoría:</label>
            <select name="idcategoria" class="form-control" required>
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->idcategoria }}" {{ old('idcategoria') == $categoria->idcategoria ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen del producto:</label>
            <input type="file" name="imagen" class="form-control-file" accept="image/*" required>
        </div>

        <div class="form-group">
            <label class="form-label">Tallas y stock por talla:</label>
            <div class="tallas-grid" id="tallas-container"></div>
        </div>

        <button type="submit" class="boton-guardar">Guardar producto</button>
        <a href="{{ url()->previous() }}" class="boton-cancelar">Cancelar</a>
    </form>
</div>

{{-- Mapeo de tallas para JS --}}
<script>
    window.tallasDB = {
        @foreach ($tallas as $talla)
            "{{ $talla->nombre }}" : {{ $talla->idtalla }},
        @endforeach
    };
</script>
<script src="{{ asset('js/tallas.js') }}"></script>
@endsection
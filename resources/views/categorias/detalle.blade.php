@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">
@endsection

@section('content')
<div class="detalle-body">
    <h1>{{ $producto->nombre }}</h1>
    <div class="contenedor-detalle">
        <div class="imagen-detalle">
            <img src="{{ asset('images/' . $producto->categoria->nombre . '/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
        </div>
        <div class="info-detalle">
            <p>{{ $producto->descripcion }}</p>
            <p class="precio">{{ $producto->precioFormateado }}</p>

            <form method="POST" action="{{ route('carrito.agregar') }}">
                @csrf
                <input type="hidden" name="idproducto" value="{{ $producto->idproducto }}">

                <label for="talla">Selecciona una talla:</label>
                <select name="talla" id="talla" required>
                    @foreach ($tallas as $talla)
                        <option value="{{ $talla->idtalla }}">{{ $talla->nombre }}</option>
                    @endforeach
                </select>

                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

                <button type="submit">Agregar al carrito</button>
            </form>
        </div>
    </div>
</div><br>
@endsection

@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/detalle.css') }}">
@endsection

@section('content')
<div class="detalle-body">
    <h1 class="titulo-producto">{{ $producto->nombre }}</h1>
    <div class="contenedor-detalle">
        <div class="imagen-detalle">
            <img src="{{ asset('images/' . $producto->categoria->nombre . '/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
        </div>
        <div class="info-detalle">
            <p class="descripcion">{{ $producto->descripcion }}</p>
            <p class="precio">{{ $producto->precioFormateado }}</p>

            <form method="POST" action="{{ route('carrito.agregar') }}" @guest onsubmit="event.preventDefault();" @endguest>
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
            
                @if (!Auth::check())
                <button type="button" class="abrir-login-modal">🛒 Agregar al carrito</button>
                @else
                <button type="submit">🛒 Agregar al carrito</button>
                @endif
            </form>
            
        </div>
    </div>
</div>
@include('partials.reseñas', ['producto' => $producto])
@endsection

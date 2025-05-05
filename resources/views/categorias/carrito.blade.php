@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <h2 class="mb-4">Carrito de Compras</h2>

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp

                    @foreach(session('carrito') as $id => $item)
                        @php
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['producto'] }}</td>
                            <td>${{ number_format($item['precio'], 0, ',', '.') }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td>${{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('carrito.eliminar') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="clave" value="{{ $id }}">
                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total:</td>
                        <td class="fw-bold">${{ number_format($total, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <form action="{{ route('carrito.vaciar') }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm" type="submit">Vaciar carrito</button>
            </form>
            <a href="{{ url('/') }}" class="btn btn-primary">Seguir comprando</a>
        </div>
    @else
        <p>Tu carrito está vacío.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver a la tienda</a>
    @endif
</div>
@endsection

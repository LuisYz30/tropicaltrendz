@extends('layouts.app')

@section('content')
<div class="container carrito-contenedor {{ session('carrito') && count(session('carrito')) > 0 ? 'mt-5 pt-4' : 'my-5 py-4 text-center' }}">
    <h1 class="mb-3">Carrito de Compras</h1>

    @if(session('carrito') && count(session('carrito')) > 0)
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Talla</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp

                    @foreach(session('carrito') as $clave => $item)
                        @php
                            $subtotal = $item['precio'] * $item['cantidad'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>
                                <img src="{{ asset($item['imagen']) }}" alt="Imagen del producto" width="130">
                            </td>
                            <td>{{ $item['producto'] }}</td>
                            <td>${{ number_format($item['precio'], 0, ',', '.') }}</td>
                            <td>{{ $item['talla'] }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td>${{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('carrito.eliminar') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="clave" value="{{ $clave }}">
                                    <button class="btn-azul-oscuro" type="submit">X</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total:</td>
                        <td class="fw-bold">${{ number_format($total, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center gap-4 mt-1">
            <form action="{{ route('carrito.vaciar') }}" method="POST" class="form-vaciar-carrito">
                @csrf
                @method('DELETE')
                <button class="btn btn-primary boton-vaciar" type="submit">Vaciar carrito</button>
            </form>
            <form action="{{ route('pago.iniciar') }}" method="GET">
            <button class="btn-azul-oscuro boton-compra" value="Pagar ahora con PayU" >Realizar compra</button>
            </form>
        </div>
    @else
        <p>Tu carrito está vacío.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3 boton-volver">Volver a la tienda</a>
    @endif
</div><br>
@endsection

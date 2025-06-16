@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="text-danger">❌ El pago ha fallado</h1>
    <p>Hubo un problema al procesar tu pago. Por favor, intenta nuevamente.</p>
    <a href="{{ route('carrito.ver') }}" class="btn btn-primary mt-3">Volver al carrito</a>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="text-warning">⏳ Pago pendiente</h1>
    <p>Tu pago está siendo procesado. Te notificaremos cuando se confirme.</p>
    <a href="{{ route('carrito.ver') }}" class="btn btn-secondary mt-3">Volver al carrito</a>
</div>
@endsection

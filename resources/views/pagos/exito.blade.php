@extends('layouts.app')

@section('title', 'Pago Exitoso')

@section('content')
    <div class="container mt-5 text-center">
        <h1>¡Pago aprobado!</h1>
        <p>Gracias por su compra. Su pago ha sido procesado correctamente.</p>
        <a href="{{ route('index') }}" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
@endsection
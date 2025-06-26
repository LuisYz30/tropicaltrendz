@extends('layouts.app')

@section('title', 'Pago Exitoso')

@section('content')
<div class="container d-flex justify-content-center align-items-center mt-5">
    <div class="card p-4 shadow-lg exito-modal mb-3">
        <div class="card-body text-center">
            <img src="{{ asset('images/LogoEmpresa/LogoTT_sinfondo.png') }}" alt="Logo" class="mb-4" style="width: 120px;">
            <h2 class=" mb-3">¡Pago aprobado!</h2>
            <p class="fs-5">Gracias por su compra. Su pago ha sido procesado correctamente.</p>
            <div class="d-grid gap-2 mt-4">
                <a href="{{ route('index') }}" class="btn-azul-oscuro text-decoration-none">Volver al inicio</a>

                @if (session('factura_id'))
                    <a href="{{ route('factura.pdf', session('factura_id')) }}" class="btn-azul-medio text-decoration-none">
                        Descargar factura en PDF
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

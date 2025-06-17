@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/images/LogoTTlogo.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        font-family: 'Poppins', sans-serif;
    }
    .card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-custom {
        background-color: #001F77;
        color: #fff;
        font-weight: bold;
        border-radius: 8px;
        transition: 0.3s ease;
    }
    .btn-custom:hover {
        background-color: #003399;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card p-4 w-100" style="max-width: 400px;">
        <div class="text-center mb-4">
            <img src="/images/logo.png" alt="Tropical Trendz" width="120">
            <h4 class="mt-3">¿Olvidaste tu contraseña?</h4>
            <p>Ingresa tu correo y te enviaremos un enlace para restablecerla.</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-custom">Enviar enlace</button>
            </div>
        </form>
    </div>
</div>
@endsection

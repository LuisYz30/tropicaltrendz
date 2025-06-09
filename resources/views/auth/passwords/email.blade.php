@extends('layouts.app')

@section('content')
<div class="container py-5" style="background-color: #f9f9f9;">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="text-center mb-4">
                <h2 style="color: #001F77;">Restablecer contraseña</h2>
                <p>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input id="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>

                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4 py-2" style="background-color: #001F77; border-color: #001F77;">
                        Enviar enlace de restablecimiento
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

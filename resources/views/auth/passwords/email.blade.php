@extends('layouts.app')

@section('content')
<div class="container justify-content-center align-items-center py-5 mt-5" style="background-color: #f9f9f9; width: 100%; max-width:600px;">
    <div class="row justify-content-center ">
        <div class="col-md-7">
            <div class="text-center mb-4">
                <h2>Restablecer contraseña</h2>
                <p>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
            </div>


            <form method="POST" action="{{ route('password.email') }}">
                @csrf         
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required autofocus>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-azul-oscuro">
                        Enviar enlace de restablecimiento
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

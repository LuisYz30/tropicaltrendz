@extends('layouts.app')

@section('content')
<div class="container justify-content-center align-items-center py-5 mt-5" style="background-color: #f9f9f9; width: 100%; max-width:600px;">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="text-center mb-4">
                <h2>Restablece tu contraseña</h2>
                <p>Ingresa tu nueva contraseña para completar el proceso.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input 
                        type="email" 
                        name="email" 
                        id="email"
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        placeholder="Correo electrónico"
                        class="form-control @error('email') is-invalid @enderror"
                    >
                    @error('email')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        required
                        placeholder="Nueva contraseña"
                        class="form-control @error('password') is-invalid @enderror"
                    >
                    @error('password')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group mb-4">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation"
                        required
                        placeholder="Confirmar contraseña"
                        class="form-control"
                    >
                </div>

                <div class="text-center">
                    <button type="submit" class="btn-azul-oscuro">
                        Restablecer contraseña
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white text-center fs-5 fw-bold">
                    Restablece tu contraseña
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo electrónico</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email"
                                value="{{ old('email') }}" 
                                required 
                                autofocus
                                class="form-control @error('email') is-invalid @enderror"
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Nueva contraseña</label>
                            <input 
                                type="password" 
                                name="password" 
                                id="password"
                                required
                                class="form-control @error('password') is-invalid @enderror"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar nueva contraseña</label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                id="password_confirmation"
                                required
                                class="form-control"
                            >
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">
                                Restablecer contraseña 
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container-fluid min-vh-100 d-flex justify-content-center align-items-center ">
    <div class="row shadow-lg rounded-4 overflow-hidden edit-modal" style="max-width: 1100px; width: 100%;">

        <!-- Imagen lateral -->
        <div class="col-md-6 d-none d-md-block p-0">
            <img src="{{ asset('images/Nosotros/beach-yoga.jpg') }}" alt="Imagen lateral" class="img-fluid h-100 w-100 object-fit-cover">
        </div>

        <!-- Contenido centrado del formulario -->
        <div class="col-md-6 d-flex align-items-center bg-white">
            <div class="w-100 px-5 py-4">

                <h2 class="text-center mb-4 fw-bold perfil-header">
                    Editar Perfil
                </h2>

                <form method="POST" action="{{ route('perfil.update') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="name" class="form-control perfil-input" value="{{ old('name', $user->name) }}" placeholder="Nombre" required>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        <input type="tel" name="telefono" class="form-control perfil-input" value="{{ old('telefono', $user->telefono) }}" placeholder="Teléfono">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-house-door-fill"></i></span>
                        <input type="text" name="direccion" class="form-control perfil-input" value="{{ old('direccion', $user->direccion) }}" placeholder="Dirección">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn-azul-oscuro">Actualizar Perfil</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

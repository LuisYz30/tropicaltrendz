<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Correo electrónico -->
            <div>
                <label for="email">Correo Electrónico</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus />
            </div>

            <!-- Nueva contraseña -->
            <div class="mt-4">
                <label for="password">Nueva Contraseña</label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirmar contraseña -->
            <div class="mt-4">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button class="btn btn-primary">
                    Confirmar Cambio
                </button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

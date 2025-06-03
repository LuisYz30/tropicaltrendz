<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tropical Trendz</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome para iconos --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    {{-- Estilos personalizados --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nosotros.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detalle.css')}}">
    <link rel="stylesheet" href="{{ asset('css/carrito.css')}}">
    <link rel="stylesheet" href="{{ asset('css/filtro.css')}}">
    <link rel="stylesheet" href="{{ asset('css/avatar-usuario.css')}}">
    <link rel="stylesheet" href="{{ asset('css/reseñas.css')}}">
    <link rel="stylesheet" href="{{ asset('css/formulario-productos.css')}}">

    {{-- Favicon opcional --}}
    <link rel="icon" href="{{ asset('Imagenes/logo.ico') }}" type="image/x-icon">
</head>
<body class="d-flex flex-column min-vh-100">

    {{-- Navbar --}}
    <nav class="">
    @include('partials.navbar')
    </nav>
    {{-- Contenido principal --}}
    <main class="@yield('main-class', 'pt-5 mt-4') flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    
    {{-- Bootstrap JS y scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/carrusel_reseñas.js')}}"></script>
    <script src="{{ asset('js/detalle.js')}}"></script>
    <script src="{{ asset('js/login-redirect.js') }}"></script>
    <script src="{{ asset('js/alertas.js')}}"></script>
    
    <!-- Mostrar notificaciones desde sesión -->
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tropical Trendz</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{--iconos --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />

    {{-- Estilos personalizados --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nosotros.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detalle.css')}}">
    <link rel="stylesheet" href="{{ asset('css/carrito.css')}}">
    <link rel="stylesheet" href="{{ asset('css/filtro.css')}}">
    <link rel="stylesheet" href="{{ asset('css/avatar-usuario.css')}}">
    <link rel="stylesheet" href="{{ asset('css/reseñas.css')}}">
    <link rel="stylesheet" href="{{ asset('css/formulario-productos.css')}}">
    <link rel="stylesheet" href="{{ asset('css/metodos_de_pago.css')}}">
    <link rel="stylesheet" href="{{ asset('css/FAQ.css')}}">
    <link rel="stylesheet" href="{{ asset('css/informes.css')}}">
    <link rel="stylesheet" href="{{ asset('css/exito.css') }}" >
    
</head>


<body class="d-flex flex-column min-vh-100">

    <div id="loader-overlay">
    <div class="loader"></div>
    </div>
    {{-- Navbar --}}
    <nav class="">
    @include('partials.navbar')
    </nav>
    {{-- Contenido principal --}}
    <main class="@yield('main-class', 'pt-5 mt-4') flex-grow-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
    @include('partials.footer')
    </footer>

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Toastr JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{--Sweet Alert--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&family=Lilita+One&display=swap" rel="stylesheet">
    
    {{-- Scripts personalizados --}}
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/carrusel_reseñas.js')}}"></script>
    <script src="{{ asset('js/detalle.js')}}"></script>
    <script src="{{ asset('js/login-redirect.js') }}"></script>
    <script src="{{ asset('js/informes.js')}}"></script>
    <script src="{{ asset('js/informes.js')}}"></script>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
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

    @if ($errors->any())
    <script>
        $(document).ready(function() {
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach

            // Abrir automáticamente el modal de registro si hubo errores ahí
            $('#registroModal').modal('show');

            // O si el error fue al iniciar sesión, abre ese modal
            $('#loginModal').modal('show');
        });
    </script>
@endif
@if (session('status'))
<script>
    $(document).ready(function () {
        toastr.success("{{ session('status') }}");
    });
</script>
@endif

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>

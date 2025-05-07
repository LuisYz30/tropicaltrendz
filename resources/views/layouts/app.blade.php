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

    {{-- Estilos personalizados --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nosotros.css') }}">

    {{-- Favicon opcional --}}
    <link rel="icon" href="{{ asset('Imagenes/logo.ico') }}" type="image/x-icon">
</head>
<body>

    {{-- Navbar --}}
    @include('layouts.navbar')

    {{-- Contenido principal --}}
    <main class="pt-5 mt-5">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- resources/views/layouts/navbar.blade.php -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">
        <!-- Botón Hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo de la tienda -->
        <a class="navbar-brand d-flex d-lg-block mx-auto fw-bold" href="{{ route('home') }}">TROPICAL TRENDZ</a>

        <!-- Menú colapsable -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('mujer') }}">Mujer</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('hombre') }}">Hombre</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('ninos') }}">Niños</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a></li>
            </ul>
            
             <!-- Sección de usuario con Dropdown de Bootstrap -->
             <div class="d-flex align-items-center ms-3 user-section">
                @auth
                    <div class="dropdown">
                        <!-- Botón que abre el dropdown -->
                        <button class="btn dropdown-toggle d-flex align-items-center bg-transparent border-0" 
                                type="button" 
                                id="dropdownMenuButton" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="me-2">{{ Auth::user()->name }}</span>
                        </button>
                        
                        <!-- Menú desplegable -->
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuButton">
                            @if(Auth::user()->role === 'admin')
                            <li>
                                <a class="dropdown-item" href="{{ route('productos.create') }}">
                                    <i class="fas fa-plus-circle me-2"></i> Nuevo Producto
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.informes') }}">
                                    <i class="fas fa-chart-line me-2"></i> Informes
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                        @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="fas fa-user-edit me-2"></i> Editar Perfil
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-azul-oscuro text-decoration-none me-2">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="btn-azul-medio text-decoration-none me-2">Registrarse</a>
                @endauth
            </div>   
        </div>
        
        <!-- Carrito (sin cambios) -->
        <div class="d-flex">
            <button class="carro" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCarrito">
                <img src="{{ asset('Imagenes/car1.svg') }}" alt="Carrito">
            </button>
        </div>
    </div>
</nav>
<!-- resources/views/layouts/navbar.blade.php -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo -->
        <a href="{{ route('index') }}">
            <img src="{{ asset('images/LogoEmpresa/logoletrasnav.png') }}" alt="Logo" class="logo-nav">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenedor central con menú y usuario -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav me-4">
                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('mujer') }}">Mujer</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('hombre') }}">Hombre</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('niños') }}">Niños</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('nosotros') }}">Nosotros</a></li>
            </ul>

            <!-- Sección de usuario -->
            <div class="d-flex align-items-center user-section posicion-usuario">
                @auth
                    <div class="dropdown d-flex align-items-center">
                        <button class="btn dropdown-toggle d-flex align-items-center bg-transparent border-0" 
                        type="button" 
                        id="dropdownMenuButton" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                    <div class="user-avatar me-2">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span>{{ Auth::user()->name }}</span>
                </button>
                
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuButton">
                    @if(Auth::user()->rol === 'admin')
                        <li>
                            <a class="dropdown-item" href="{{ route('productos.index') }}">
                                <i class="fas fa-list me-2"></i> Ver Productos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('productos.create') }}">
                                <i class="fas fa-plus-circle me-2"></i> Nuevo Producto
                            </a>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item" href="{{ route('admin.informes') }}">
                                <i class="fas fa-chart-line me-2"></i> Informes
                            </a>
                        </li> --}}
                        <li><hr class="dropdown-divider"></li>
                    @endif
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
                    <a href='#' id="btn-iniciar" class="btn-azul-oscuro text-decoration-none me-2">Iniciar Sesión</a>
                    <a href='#' id="btn-registrar" class="btn-azul-medio text-decoration-none me-2">Registrarse</a>
                @endauth
            </div>
        </div>

        <!-- Carrito -->
        <div class="d-flex align-items-center">
                <a href="{{ route('carrito.ver') }}" class="carro position-relative">
                <img src="{{ asset('images/car1.svg') }}" alt="Carrito">

                @php
                    $cantidadCarrito = is_array(session('carrito')) ? count(session('carrito')) : 0;
                @endphp

                @if($cantidadCarrito > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $cantidadCarrito }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</nav>


<!-- MODAL LOGIN -->
<div class="modal-fade" id="login-modal">
    <div class="formulario">
        <button class="close-modal" id="close-login">&times;</button>
        <div class="form-container">
            <div class="form-image">
               <img src="{{asset('images/img-login/fondo-login.png')}}" alt="Imagen" style="width:100%; height:100%; object-fit:cover;">
            </div>
            <div class="form-content-login">
                <div class="logo-login">
                    <img src="{{asset('images/LogoEmpresa/LogoTT.jpeg')}}" alt="Logo" class="img-fluid" style="width: 110px; height: auto;">
                </div>
                <h1>Iniciar Sesión</h1>
                <p class="form-subtitle">Accede a tu cuenta y vive el verano todo el año🩱</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="redirectAfterLogin" id="redirectAfterLogin">
                
                    <div class="username">
                        <input type="email" name="email" required>
                        <label>Correo electrónico</label>
                    </div>
                    <div class="username">
                        <input type="password" name="password" required>
                        <label>Contraseña</label>
                    </div>
                    <div class="recordar"><a href="#">¿Olvidó su contraseña?</a></div>
                    <button type="submit" class="btn-ingresar">Ingresar</button>
                </form>
                <div class="google-login">
                  <img src="{{asset('images/google.svg')}}"  alt="Google">
                </div>
                <div class="registrarse">
                    <a href="#" id="btn-registro-enlace">¿No tienes cuenta? Regístrate</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL REGISTRO -->
<div class="modal-fade" id="register-modal">
    <div class="formulario">
        <button class="close-modal" id="close-register">&times;</button>
        <div class="form-container">
            <div class="form-content-registro">
                <h2>Regístrate</h2>
                <p class="form-subtitle">Crea tu cuenta para comenzar tu aventura tropical🌴</p>
                <form method="POST" action="{{ route('register') }}">

                    @csrf
                    <div class="username">
                        <input type="text" name="name" required>
                        <label>Nombre</label>
                    </div>
                    <div class="username">
                        <input type="tel" name="telefono" required>
                        <label>Teléfono</label>
                    </div>
                    <div class="username">
                        <input type="email" name="email" required>
                        <label>Correo electrónico</label>
                    </div>
                    <div class="username">
                        <input type="password" name="password" required>
                        <label>Contraseña</label>
                    </div>
                    <button type="submit" class="btn-registrarse">Registrarse</button>
                </form>
                <div class="google-login">
                    <img src="{{asset('images/google.svg')}}"  alt="Google">
                </div>
                <div class="loguearse">
                    <a href="#" id="btn-iniciar-enlace">¿Ya tienes cuenta? Inicia Sesión</a>
                </div>
            </div>
            <div class="form-image">
                <img src="{{asset('images/img-login/Fondo-login2.png')}}" alt="Imagen" style="width:100%; height:100%; object-fit:cover;">
            </div>
        </div>
    </div>
</div>
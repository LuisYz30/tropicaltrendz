<div class="reseñas-container py-5 px-3">
    <h2 class="text-center fs-1 mb-4">Reseñas de Nuestros Clientes</h2>

    {{-- Formulario --}}
    @if(auth()->check())
        <h2 class="text-center mb-3">Déjanos tu opinión</h2>
        <form action="{{ route('reseñas.store') }}" method="POST" class="reseña-form mx-auto">
            @csrf
            <input type="hidden" name="producto_id" value="{{ $producto->idproducto }}">

            <div class="mb-3">
                <label for="calificacion" class="form-label">Calificación</label>
                <select class="form-select reseña-select" name="calificacion" id="calificacion" required>
                    <option value="5">★★★★★ - Excelente</option>
                    <option value="4">★★★★☆ - Muy bueno</option>
                    <option value="3">★★★☆☆ - Bueno</option>
                    <option value="2">★★☆☆☆ - Regular</option>
                    <option value="1">★☆☆☆☆ - Malo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="comentario" class="form-label">Tu Opinión</label>
                <textarea class="form-control reseña-textarea mb-4" name="comentario" id="comentario" rows="3" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-azul-oscuro">Enviar Reseña</button>
            </div>
        </form>
    @else
        <p class="text-center abrir-login-modal"><a href="#">Inicia sesión</a> para dejar una reseña.</p>
    @endif

    {{-- Opiniones --}}
    <h2 class="text-center mt-4">Opiniones de los clientes</h2>

    <div class="reseña-carousel-wrapper">
        <button class="carousel-btn left" id="prevBtn" style="display: none;">&#9664;</button>

        <div class="reseña-carousel-container">
            <div class="reseña-carousel" id="reseñaCarousel">
                @forelse ($producto->reseñas->chunk(4) as $chunk)
                    <div class="reseña-page">
                        @foreach ($chunk as $reseña)
    <div class="reseña-card position-relative">
        @if(auth()->check() && auth()->user()->rol === 'admin')
            <form action="{{ route('reseñas.destroy', $reseña->id) }}" method="POST" class="eliminar-reseña-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-eliminar" aria-label="Eliminar">X</button>
            </form>
        @endif

        <h5 class="fw-bold mb-1">{{ $reseña->user->name }}</h5>
        <div class="reseña-stars mb-1 text-warning">
            {!! str_repeat('★', $reseña->calificacion) !!} {!! str_repeat('☆', 5 - $reseña->calificacion) !!}
        </div>
        <p class="mb-0">{{ $reseña->comentario }}</p>
    </div>
        @endforeach
                    </div>
                @empty
                    <p class="text-muted sin-reseña">Este producto aún no tiene reseñas.</p>
                @endforelse
            </div>
        </div>

        <button class="carousel-btn right" id="nextBtn" style="display: {{ $producto->reseñas->count() > 4 ? 'block' : 'none' }};">&#9654;</button>
    </div>
</div>

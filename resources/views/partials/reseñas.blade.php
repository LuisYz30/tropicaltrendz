<div class="reseñas-container py-5 px-3">
    <h2 class="text-center fw-bold mb-4">Reseñas de Nuestros Clientes</h2>

    {{-- Formulario --}}
    @if(auth()->check())
        <h3 class="text-center mb-3">Déjanos tu opinión</h3>
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
                <textarea class="form-control reseña-textarea" name="comentario" id="comentario" rows="3" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn reseña-btn">Enviar Reseña</button>
            </div>
        </form>
    @else
        <p class="text-center abrir-login-modal"><a href="#">Inicia sesión</a> para dejar una reseña.</p>
    @endif

    {{-- Opiniones --}}
    <h3 class="text-center mt-5">Opiniones de los clientes</h3>

    <div class="reseña-carousel-wrapper">
        <button class="carousel-btn left" id="prevBtn" style="display: none;">&#9664;</button>

        <div class="reseña-carousel-container">
            <div class="reseña-carousel" id="reseñaCarousel">
                @forelse ($producto->reseñas->chunk(4) as $chunk)
                    <div class="reseña-page">
                        @foreach ($chunk as $reseña)
                            <div class="reseña-card">
                                <h5 class="fw-bold mb-1">{{ $reseña->user->name }}</h5>
                                <div class="reseña-stars mb-1 text-warning">
                                    {!! str_repeat('★', $reseña->calificacion) !!} {!! str_repeat('☆', 5 - $reseña->calificacion) !!}
                                </div>
                                <p class="mb-0">{{ $reseña->comentario }}</p>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <p class="text-muted text-center">Este producto aún no tiene reseñas.</p>
                @endforelse
            </div>
        </div>

        <button class="carousel-btn right" id="nextBtn" style="display: {{ $producto->reseñas->count() > 4 ? 'block' : 'none' }};">&#9654;</button>
    </div>
</div>

@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 main-container">
    <!-- Sección Acerca de -->
    <section class="row g-0 min-vh-100 align-items-stretch section-container">
        <div class="col-lg-5 col-md-12 p-lg-5 p-4 d-flex flex-column justify-content-center bg-white shadow content-column">
            <h2 class="mb-4 position-relative pb-3">Acerca de</h2>
            <p class="mb-4">En Tropical Trendz creemos que cada cuerpo merece brillar bajo el sol con estilo y confianza. Somos una marca que nace del amor por el mar, la arena y la vibra tropical, con el objetivo de ofrecer trajes de baño únicos, cómodos y con mucha personalidad.</p>
            <p>Nuestros diseños están inspirados en las tendencias más frescas del momento, fusionadas con toques caribeños y cortes pensados ​​para realzar tu esencia. Trabajamos con materiales de alta calidad y nos enfocamos en detalles que hacen la diferencia, porque sabemos que cada pieza debe sentirse como una segunda piel.</p>
            <p>Ya sea que estés planeando tus vacaciones soñadas o simplemente buscando ese bikini o enterizo perfecto para desconectarte del mundo, en Tropical Trendz encontrarás ese look que habla por ti.</p>
        </div>
        <div class="col-lg-7 col-md-12 image-column overflow-hidden position-relative">
            <img src="images/Nosotros/surfer.jpg" alt="Modelo con tabla de surf" class="w-100 h-100 object-fit-cover">
        </div>
    </section>
    
    <!-- Sección Misión -->
    <section class="row g-0 min-vh-100 align-items-stretch section-container reverse-section">
        <div class="col-lg-7 col-md-12 image-column overflow-hidden position-relative order-lg-1 order-2">
            <img src="images/Nosotros/beach-person.jpg" alt="Modelo en la playa" class="w-100 h-100 object-fit-cover">
        </div>
        <div class="col-lg-5 col-md-12 p-lg-5 p-4 d-flex flex-column justify-content-center bg-white shadow content-column order-lg-2 order-1">
            <h2 class="mb-4 position-relative pb-3">Misión</h2>
            <p class="mb-4">En Tropical Trendz tenemos la misión de crear trajes de baño que empoderen, inspiren y representen la autenticidad de cada persona. Diseñamos con pasión, calidad y estilo, buscando que cada prenda refleje libertad, confianza y el espíritu vibrante del trópico.</p>
            <p>Queremos ser más que una marca: un movimiento que celebra la diversidad de cuerpos, pensamientos y formas de vivir la vida bajo el sol.</p>
            <div class="mission-values mt-4">
                <div class="value-item mb-3">
                    <i class="bi bi-heart-fill me-2"></i> Pasión por el diseño
                </div>
                <div class="value-item mb-3">
                    <i class="bi bi-people-fill me-2"></i> Enfoque en las personas
                </div>
                <div class="value-item">
                    <i class="bi bi-star-fill me-2"></i> Calidad excepcional
                </div>
            </div>
        </div>
    </section>
    
    <!-- Sección Visión -->
    <section class="row g-0 min-vh-100 align-items-stretch section-container">
        <div class="col-lg-5 col-md-12 p-lg-5 p-4 d-flex flex-column justify-content-center bg-white shadow content-column">
            <h2 class="mb-4 position-relative pb-3">Visión</h2>
            <p class="mb-4">En Tropical Trendz aspiramos con ser una marca referente en el mundo de la moda de trajes de baño, reconocida por su autenticidad, calidad y conexión con el estilo de vida tropical.</p>
            <p>Aspiramos a expandir nuestra esencia a nivel nacional e internacional, llevando nuestros diseños a cada rincón donde el sol brille y la libertad se sienta.</p>
            <p>Queremos inspirar una comunidad que se ame, se exprese y se sienta orgullosa de quién es, luciendo trajes de baño que hablan su mismo idioma: el del color, la vibra y la autenticidad.</p>
        </div>
        <div class="col-lg-7 col-md-12 image-column overflow-hidden position-relative">
            <img src="images/Nosotros/beach-yoga.jpg" alt="Modelo en bikini azul" class="w-100 h-100 object-fit-cover">
        </div>
    </section>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
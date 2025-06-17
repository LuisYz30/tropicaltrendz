@extends('layouts.app')
@section('content')
@section('main-class', '')
    
 
<section class="seccion-nosotros ">
    <div class="container">

    <!-- Acerca de -->
    <div class="row acerca-de">

        <div class="col-md-7 px-5 text-start d-flex flex-column justify-content-center">
            <h3 class="seccion-titulo mb-3">| Acerca de</h3>
            <p class="mb-3">En Tropical Trendz creemos que cada cuerpo merece brillar bajo el sol con estilo y confianza. Somos una marca que nace del amor por el mar, la arena y la vibra tropical, con el objetivo de ofrecer trajes de baño únicos, cómodos y con mucha personalidad.</p>
            <p class="mb-3">Nuestros diseños están inspirados en las tendencias más frescas del momento, fusionadas con toques caribeños y cortes pensados ​​para realzar tu esencia. Trabajamos con materiales de alta calidad y nos enfocamos en detalles que hacen la diferencia, porque sabemos que cada pieza debe sentirse como una segunda piel.</p>
        </div>
    
        <div class="col-md-5 d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/LogoEmpresa/LogoTT_celeste.PNG') }}" alt="Logo Tropical Trendz" class="img-fluid acerca-image">
        </div>
    </div>


<!-- Misión -->
<div class="row mission-box mb-4" data-aos="fade-left">
  
    <div class="col-md-4 p-0">
        <img src="{{ asset('images/Nosotros/beach-person.jpg') }}" alt="Misión" class="img-fluid mission-image">
    </div>

    <div class="col-md-8 text-white d-flex flex-column justify-content-center p-5 mission-text" data-aos="fade-down-left">
        <h2 class="titulo-mision mb-3" >Misión</h2>
        <p class="mb-3">En Tropical Trendz tenemos la misión de crear trajes de baño que empoderen, inspiren y representen la autenticidad de cada persona. Diseñamos con pasión, calidad y estilo, buscando que cada prenda refleje libertad, confianza y el espíritu vibrante del trópico.</p>
        <p class="mb-3">Queremos ser más que una marca: un movimiento que celebra la diversidad de cuerpos, pensamientos y formas de vivir la vida bajo el sol.</p>
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
</div>


   <!-- Visión -->
<div class="row mission-box mb-4" data-aos="fade-right">

    <div class="col-md-8 text-white d-flex flex-column justify-content-center p-5 mission-text" data-aos="fade-down-right">
            <h2 class="titulo-mision mb-3" >Visión</h2>
            <p class="mb-3">En Tropical Trendz aspiramos con ser una marca referente en el mundo de la moda de trajes de baño, reconocida por su autenticidad, calidad y conexión con el estilo de vida tropical.</p>
            <p class="mb-3">Aspiramos a expandir nuestra esencia a nivel nacional e internacional, llevando nuestros diseños a cada rincón donde el sol brille y la libertad se sienta.</p>
            <p class="mb-3">Queremos inspirar una comunidad que se ame, se exprese y se sienta orgullosa de quién es, luciendo trajes de baño que hablan su mismo idioma: el del color, la vibra y la autenticidad.</p>
    </div>

    <div class="col-md-4 p-0">
        <img src="{{ asset('images/Nosotros/surfer.jpg') }}" alt="Misión" class="img-fluid mission-image">
    </div>
</div>
</div>
</section>

 
@endsection
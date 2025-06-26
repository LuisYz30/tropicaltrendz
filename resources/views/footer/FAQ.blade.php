@extends('layouts.app')

@section('content')
<section class="faq-section">
    <h2 class="faq-title" data-aos="fade-down">Preguntas Frecuentes</h2>

    <div class="faq-container">
        @php
            $preguntas = [
                ['pregunta' => '¿Cuál es el tiempo de entrega?', 'respuesta' => 'Los envíos tardan entre 3 a 5 días hábiles según tu ubicación.'],
                ['pregunta' => '¿Puedo cambiar la talla?', 'respuesta' => 'Sí, puedes realizar cambios dentro de los primeros 7 días.'],
                ['pregunta' => '¿Qué métodos de pago aceptan?', 'respuesta' => 'Aceptamos tarjetas, PSE, y pagos en efectivo a través de Efecty.'],
                ['pregunta' => '¿Hacen envíos a todo el país?', 'respuesta' => 'Sí, hacemos envíos nacionales en toda Colombia.'],
                ['pregunta' => '¿Qué hago si el producto llega defectuoso?', 'respuesta' => 'Contáctanos dentro de las 48 horas después de recibir tu producto para hacer un cambio o reembolso.']
            ];
        @endphp

        @foreach($preguntas as $index => $faq)
        <div class="faq-card {{ $index % 2 == 0 ? 'left' : 'right' }}" data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
            <div class="faq-question">{{ $faq['pregunta'] }}</div>
            <div class="faq-answer">{{ $faq['respuesta'] }}</div>
        </div>
        @endforeach
    </div>
</section>
@endsection

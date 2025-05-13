@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h1>Bienvenido a Tropical Trendz</h1>
    <p>Explora nuestra colección exclusiva de trajes de baño.</p>
    <a href="{{ route('hombre') }}" class="btn btn-primary m-2">Hombre</a>
    <a href="{{ route('mujer') }}" class="btn btn-danger m-2">Mujer</a>
    <a href="{{ route('niños') }}" class="btn btn-success m-2">Niños</a>
</div>
@endsection
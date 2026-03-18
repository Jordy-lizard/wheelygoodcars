@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>{{ $car->brand }} {{ $car->model }}</h1>
        <p><strong>Bouwjaar:</strong> {{ $car->year }}</p>
        <p><strong>Prijs:</strong> €{{ number_format($car->price, 2) }}</p>
        <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>

        @if($car->photo)
            <div>
                <strong>Foto:</strong>
                <img src="{{ asset('storage/' . $car->photo) }}" alt="Auto Foto" style="width: 300px; height: auto;">
            </div>
        @endif
    </div>
@endsection

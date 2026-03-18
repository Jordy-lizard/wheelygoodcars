@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Alle Auto's Te Koop</h1>

        @forelse($cars as $car)
            <div class="car-item">
                <h3>{{ $car->brand }} {{ $car->model }}</h3>
                <p>{{ $car->year }} - €{{ number_format($car->price, 2) }}</p>
                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info">Bekijk Details</a>
            </div>
            <hr>
        @empty
            <p>Er zijn geen auto's beschikbaar op dit moment.</p>
        @endforelse
    </div>
@endsection

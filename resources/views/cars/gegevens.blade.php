@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Stap 2: Gegevens Invullen</h1>

        <form action="{{ route('cars.opslaan') }}" method="POST">
            @csrf
            <input type="hidden" name="license_plate" value="{{ $carData['license_plate'] }}">

            <div class="form-group">
                <label for="brand">Merk:</label>
                <input type="text" name="brand" class="form-control" value="{{ $carData['brand'] }}" required>
            </div>

            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" class="form-control" value="{{ $carData['model'] }}" required>
            </div>

            <div class="form-group">
                <label for="year">Bouwjaar:</label>
                <input type="number" name="year" class="form-control" value="{{ $carData['year'] }}" required>
            </div>

            <div class="form-group">
                <label for="price">Prijs (€):</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Auto Opslaan</button>
        </form>
    </div>
@endsection

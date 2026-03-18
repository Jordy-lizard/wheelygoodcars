@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Auto Bewerken</h1>

        <!-- Succes- of foutmeldingen weergeven -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('cars.update', $car->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="license_plate">Kenteken:</label>
                <input type="text" id="license_plate" class="form-control" value="{{ $car->license_plate }}" disabled>
            </div>

            <div class="form-group">
                <label for="brand">Merk:</label>
                <input type="text" id="brand" class="form-control" value="{{ $car->brand }}" disabled>
            </div>

            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" id="model" class="form-control" value="{{ $car->model }}" disabled>
            </div>

            <div class="form-group">
                <label for="year">Bouwjaar:</label>
                <input type="text" id="year" class="form-control" value="{{ $car->year }}" disabled>
            </div>

            <!-- Toon de foto van de auto -->
            <div class="form-group">
                <label for="photo">Foto:</label>
                <div>
                    @if($car->photo)
                        <img src="{{ asset('storage/' . $car->photo) }}" alt="Auto Foto" style="width: 200px; height: auto;">
                    @else
                        <p>Geen foto beschikbaar</p>
                    @endif
                </div>
            </div>

            <!-- Prijs aanpassen -->
            <div class="form-group">
                <label for="price">Prijs (€):</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ $car->price }}" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Opslaan</button>
        </form>
    </div>
@endsection

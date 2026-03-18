@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-5">Alle auto's te koop</h1>

        <!-- Grid container voor auto's -->
        <div class="car-grid">
            @foreach($cars as $car)
                <div class="car-item" data-id="{{ $car->id }}">
                    <div class="car-image">
                        @if($car->photo)
                            <img src="{{ asset('storage/' . $car->photo) }}" alt="Auto Foto" style="width: 100%; height: auto;">
                        @else
                            <p>Geen foto beschikbaar</p>
                        @endif
                    </div>
                    <div class="car-info">
                        <h3>{{ $car->brand }} {{ $car->model }}</h3>
                        <p><strong>Prijs:</strong> €{{ number_format($car->price, 2) }}</p>
                        <!-- Voeg de Bekijk knop toe -->
                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Bekijk auto</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Voeg de CSS en JavaScript voor de grid en willekeurige uitlichting toe -->
    <style>
        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .car-item {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        }

        .car-item:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
        }

        .car-item.selected {
            transform: scale(1.2); /* Verhoog de grootte van geselecteerde auto's */
            z-index: 10; /* Zorg ervoor dat de geselecteerde auto boven andere ligt */
            background-color: #ffdf00; /* Voeg een opvallende achtergrondkleur toe */
            color: #333; /* Verander de tekstkleur */
        }

        .car-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .car-info {
            margin-top: 10px;
            text-align: center;
        }

        .car-info h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .btn-primary {
            margin-top: 10px;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <script>
        // JavaScript om willekeurige auto's uit te lichten
        document.addEventListener('DOMContentLoaded', function() {
            const carItems = document.querySelectorAll('.car-item');

            // Aantal willekeurige auto's om uit te lichten
            const numberOfHighlightedCars = 3; // Dit kun je aanpassen naar wens

            // Selecteer willekeurige auto's om te vergroten
            let randomCars = [];
            while (randomCars.length < numberOfHighlightedCars) {
                const randomIndex = Math.floor(Math.random() * carItems.length);
                if (!randomCars.includes(randomIndex)) {
                    randomCars.push(randomIndex);
                }
            }

            // Voeg de 'selected' class toe aan willekeurige auto's
            randomCars.forEach(index => {
                carItems[index].classList.add('selected');
            });
        });
    </script>
@endsection

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

    <!-- Popup voor het aantal weergaven -->
    <div class="popup" id="popup" style="display:none; position: fixed; top: 20%; left: 50%; transform: translateX(-50%); background-color: rgba(0, 0, 0, 0.7); color: white; padding: 20px; border-radius: 10px; z-index: 1000;">
        <p>{{ $car->views }} klanten bekeken deze auto vandaag.</p>
    </div>

    <!-- Voeg JavaScript toe voor de popup timing -->
    <script>
        // 10 seconden na het laden van de pagina wordt de popup getoond
        setTimeout(function() {
            var popup = document.getElementById("popup");
            popup.style.display = "block";
        }, 10000); // 10 seconden

        // 5 seconden later wordt de popup weer verborgen
        setTimeout(function() {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
        }, 15000); // 15 seconden
    </script>
@endsection

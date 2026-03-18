<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Stap 1: Kenteken invoeren
    public function showKentekenForm()
    {
        return view('cars.kenteken'); // Zorg ervoor dat de juiste map wordt gebruikt
    }

    // Stap 2: Controleer het kenteken en haal auto-informatie op
    public function checkKenteken(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|unique:cars,license_plate',
        ]);

        $licensePlate = $request->license_plate;

        // Haal de auto-gegevens op op basis van het kenteken
        $carData = $this->getCarDataFromLicense($licensePlate);

        // Sla de auto-gegevens op in de sessie
        session(['car_data' => $carData]);

        // Redirect naar de volgende stap (gegevens invullen)
        return redirect()->route('cars.gegevens'); // Dit moet 'cars.gegevens' zijn
    }

    // Stap 3: Gegevens invullen (merk, model, bouwjaar, prijs)
    public function showGegevensForm()
    {
        $carData = session('car_data'); // Haal de car_data uit de sessie

        if (!$carData) {
            return redirect()->route('cars.kenteken'); // Dit moet 'cars.kenteken' zijn
        }

        return view('cars.gegevens', compact('carData')); // Verwijst naar 'resources/views/cars/gegevens.blade.php'
    }

    // Stap 4: Auto opslaan
    public function opslaanAuto(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|unique:cars,license_plate',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|digits:4|integer',
            'price' => 'required|numeric',
        ]);

        // Haal alleen de velden op die je wilt massaal toewijzen
        $carData = $request->only(['license_plate', 'brand', 'model', 'year', 'price']);

        // Sla de auto op in de database
        Car::create($carData);

        // Redirect naar de kenteken pagina met een succesmelding
        return redirect()->route('cars.kenteken')->with('success', 'Auto succesvol aangeboden!');
    }

    // Functie om auto-gegevens op te halen op basis van het kenteken
    private function getCarDataFromLicense($licensePlate)
    {
        return [
            'license_plate' => $licensePlate,
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2019,
        ];
    }
}

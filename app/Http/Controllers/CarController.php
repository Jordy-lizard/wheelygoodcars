<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // Stap 1: Kenteken invoeren
    public function showKentekenForm()
    {
        return view('cars.kenteken');
    }

    // Stap 2: Controleer het kenteken en haal auto-informatie op
    public function checkKenteken(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|unique:cars,license_plate',
        ]);

        $licensePlate = $request->license_plate;

        // Haal de auto-gegevens op via je eigen logica
        $carData = $this->getCarDataFromLicense($licensePlate);

        // Sla de auto-gegevens op in de sessie
        session(['car_data' => $carData]);

        // Redirect naar de volgende stap (gegevens invullen)
        return redirect()->route('cars.gegevens');
    }

    // Stap 3: Gegevens invullen (merk, model, bouwjaar, prijs)
    public function showGegevensForm()
    {
        $carData = session('car_data'); // Haal de car_data uit de sessie

        if (!$carData) {
            return redirect()->route('cars.kenteken'); // Redirect naar kenteken als car_data niet gevonden is
        }

        return view('cars.gegevens', compact('carData'));
    }

    // Stap 4: Auto opslaan (met foto uploaden)
    public function opslaanAuto(Request $request)
    {
        // Controleer of de gebruiker is ingelogd
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Je moet ingelogd zijn om een auto aan te bieden.');
        }

        // Valideer de invoer, inclusief de foto
        $request->validate([
            'license_plate' => 'required|unique:cars,license_plate',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|digits:4|integer',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validatie voor de foto
        ]);

        // Haal alleen de velden op die je wilt massaal toewijzen
        $carData = $request->only(['license_plate', 'brand', 'model', 'year', 'price']);

        // Voeg user_id toe aan de gegevens van de auto
        $carData['user_id'] = auth()->id();

        // Verwerk de foto als deze is geüpload
        if ($request->hasFile('photo')) {
            // Sla de foto op in de public opslag en sla het pad op in de database
            $carData['photo'] = $request->file('photo')->store('cars', 'public');
        }

        // Sla de auto op in de database
        Car::create($carData);

        // Redirect naar de "Mijn aanbod" pagina met een succesmelding
        return redirect()->route('cars.mijn_aanbod')->with('success', 'Auto succesvol aangeboden!');
    }

    // Functie om auto-gegevens op te halen (bijv. via een API)
    private function getCarDataFromLicense($licensePlate)
    {
        return [
            'license_plate' => $licensePlate,
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2019,
        ];
    }

    // Stap 5: Toon het overzicht van auto's (Mijn Aanbod)
    public function mijnAanbod()
    {
        // Haal alle auto's op die de ingelogde gebruiker heeft aangeboden
        $cars = Car::where('user_id', auth()->id())->get();

        return view('cars.mijn_aanbod', compact('cars'));
    }

    // Toon het totale aanbod voor iedereen (ook niet-ingelogd)
    public function index()
    {
        $cars = Car::all(); // Geen filter op status, alle auto's ophalen
        return view('cars.index', compact('cars'));
    }

    // Toon de details van een specifieke auto
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }

    // Stap 6: Auto bewerken
    public function edit($id)
    {
        // Haal de auto op die bewerkt moet worden
        $car = Car::findOrFail($id);

        // Controleer of de ingelogde gebruiker de eigenaar van de auto is
        if ($car->user_id !== auth()->id()) {
            return redirect()->route('cars.mijn_aanbod')->with('error', 'Je hebt geen toestemming om deze auto te bewerken.');
        }

        // Toon de bewerkpagina
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        // Valideer de prijs invoer
        $request->validate([
            'price' => 'required|numeric',
        ]);

        // Haal de auto op
        $car = Car::findOrFail($id);

        // Controleer of de ingelogde gebruiker de eigenaar van de auto is
        if ($car->user_id !== auth()->id()) {
            return redirect()->route('cars.mijn_aanbod')->with('error', 'Je hebt geen toestemming om deze auto bij te werken.');
        }

        // Werk de prijs bij
        $car->update([
            'price' => $request->input('price'),
        ]);

        // Redirect naar "Mijn aanbod" met een succesmelding
        return redirect()->route('cars.mijn_aanbod')->with('success', 'Auto succesvol bijgewerkt!');
    }

    // Stap 8: Auto verwijderen
    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        // Controleer of de auto van de ingelogde gebruiker is
        if ($car->user_id !== auth()->id()) {
            return redirect()->route('cars.mijn_aanbod')->with('error', 'Je hebt geen toestemming om deze auto te verwijderen.');
        }

        // Verwijder de auto
        $car->delete();

        return redirect()->route('cars.mijn_aanbod')->with('success', 'Auto succesvol verwijderd!');
    }
}

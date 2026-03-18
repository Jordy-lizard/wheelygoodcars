<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route voor het invoeren van het kenteken (Stap 1)
Route::get('/auto-aanbieden/kenteken', [CarController::class, 'showKentekenForm'])->name('cars.kenteken');

// Route voor het controleren van het kenteken (Stap 2)
Route::post('/auto-aanbieden/check-kenteken', [CarController::class, 'checkKenteken'])->name('cars.checkKenteken');

// Route voor het invullen van de auto-gegevens (Stap 3)
Route::get('/auto-aanbieden/gegevens-invullen', [CarController::class, 'showGegevensForm'])->name('cars.gegevens');

// Route voor het opslaan van de auto (Stap 4)
Route::post('/auto-aanbieden/opslag', [CarController::class, 'opslaanAuto'])->name('cars.opslaan');

// Route voor "Mijn aanbod" (Stap 5)
Route::get('/mijn-aanbod', [CarController::class, 'mijnAanbod'])->name('cars.mijn_aanbod');

// Route voor het bewerken van een auto (Stap 6)
Route::get('/auto/{id}/bewerken', [CarController::class, 'edit'])->name('cars.edit');
Route::put('/auto/{id}', [CarController::class, 'update'])->name('cars.update');

// Route voor het verwijderen van een auto (Stap 7)
Route::delete('/auto/{id}', [CarController::class, 'destroy'])->name('cars.destroy');

// Authenticatie routes (login, register)
require __DIR__.'/auth.php';

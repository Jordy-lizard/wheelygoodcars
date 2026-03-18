<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route voor het tonen van alle auto's, toegankelijk voor iedereen
Route::get('/alle-auto\'s', [CarController::class, 'index'])->name('cars.index');

// Route voor het tonen van de details van een specifieke auto
Route::get('/auto/{id}', [CarController::class, 'show'])->name('cars.show');

// Routes voor het aanbieden van een auto (alleen voor ingelogde gebruikers)
Route::get('/auto-aanbieden/kenteken', [CarController::class, 'showKentekenForm'])->name('cars.kenteken');
Route::post('/auto-aanbieden/check-kenteken', [CarController::class, 'checkKenteken'])->name('cars.checkKenteken');
Route::get('/auto-aanbieden/gegevens-invullen', [CarController::class, 'showGegevensForm'])->name('cars.gegevens');
Route::post('/auto-aanbieden/opslag', [CarController::class, 'opslaanAuto'])->name('cars.opslaan');

// Mijn aanbod (alleen voor ingelogde gebruikers)
Route::get('/mijn-aanbod', [CarController::class, 'mijnAanbod'])->name('cars.mijn_aanbod');

// Routes voor het bewerken, bijwerken en verwijderen van auto's (alleen voor ingelogde gebruikers)
Route::get('cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('cars/{id}', [CarController::class, 'update'])->name('cars.update');
Route::delete('/auto/{id}', [CarController::class, 'destroy'])->name('cars.destroy');

// Auth routes
require __DIR__.'/auth.php';

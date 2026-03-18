<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/auto-aanbieden/kenteken', [CarController::class, 'showKentekenForm'])->name('cars.kenteken');
Route::post('/auto-aanbieden/check-kenteken', [CarController::class, 'checkKenteken'])->name('cars.checkKenteken');
Route::get('/auto-aanbieden/gegevens-invullen', [CarController::class, 'showGegevensForm'])->name('cars.gegevens');
Route::post('/auto-aanbieden/opslag', [CarController::class, 'opslaanAuto'])->name('cars.opslaan');
require __DIR__.'/auth.php';

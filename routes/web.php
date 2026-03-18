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
Route::get('/mijn-aanbod', [CarController::class, 'mijnAanbod'])->name('cars.mijn_aanbod');
Route::get('cars/{id}/edit', [CarController::class, 'edit'])->name('cars.edit');
Route::put('cars/{id}', [CarController::class, 'update'])->name('cars.update');
Route::delete('/auto/{id}', [CarController::class, 'destroy'])->name('cars.destroy');


require __DIR__.'/auth.php';

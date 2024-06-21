<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pruebas', PruebaController::class)->middleware(['auth', 'verified'])->name('pruebas');

Route::get('/', function () {
    return view('welcome');
});

// recurso creado por breeze (v173) (reemplazado por el de abajo en el v185)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [VacanteController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('vacantes.index');
Route::get('/vacantes/create', [VacanteController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('vacantes.create');
Route::get('/vacantes/{vacante}/edit', [VacanteController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('vacantes.edit');
Route::get('/vacantes/{vacante}', [VacanteController::class, 'show'])
    ->name('vacantes.show');

// Route::resource("vacantes", VacanteController::class);

// recurso creado por breeze (v173)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\PrivadoController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\VistasServiciosController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::resource('movimientos', MovimientosController::class)
->only(['index','create','store','show'])
->middleware(['auth', 'verified'])
->names('movimientos');

Route::resource('privado', PrivadoController::class)
->middleware(['auth', 'verified'])
->names('privado');

Route::resource('servicios', ServiciosController::class)
->only(['create','store','show'])
->middleware(['auth', 'verified'])
->names('servicios');
Route::post('seleccion_servicio', [ServiciosController::class, 'seleccion_servicio'])
->middleware(['auth', 'verified'])
->name('seleccion_servicio');


Route::get('lista/pdf', [PrivadoController::class, 'pdf'])->middleware(['auth', 'verified'])->name('lista.pdf');

require __DIR__.'/auth.php';

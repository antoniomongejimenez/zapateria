<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ZapatoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/carritos', [CarritoController::class, 'index'])
->middleware(['auth'])->name('carrito');

Route::post('/carritos/meter/{zapato}', [CarritoController::class, 'meter'])
->middleware(['auth'])->name('carrito.meter');

Route::post('/carritos/restar/{zapato}', [CarritoController::class, 'restar'])
->middleware(['auth'])->name('carrito.restar');

Route::post('/carritos/sumar/{zapato}', [CarritoController::class, 'sumar'])
->middleware(['auth'])->name('carrito.sumar');

Route::post('/carritos/vaciar', [CarritoController::class, 'vaciar'])
->middleware(['auth'])->name('carrito.vaciar');


Route::get('/zapatos', [ZapatoController::class, 'index'])->name('zapatos');

require __DIR__.'/auth.php';

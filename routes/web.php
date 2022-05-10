<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicViewController;
use App\Http\Controllers\RentController;

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

Route::get('/', [BasicViewController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/guide', [BasicViewController::class, 'guide']);

Route::get('/rent/cars', [BasicViewController::class, 'cars']);

Route::get('/rent/motors', [BasicViewController::class, 'motors']);

Route::get('/help', [BasicViewController::class, 'help']);

Route::get('/about', [BasicViewController::class, 'about']);

Route::middleware(['auth', 'verified'])-> group(function () {
    Route::get('/rent/car/{id}', [RentController::class, 'carFormView']);
});

Route::fallback([BasicViewController::class, 'fallback']);
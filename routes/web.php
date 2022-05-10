<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicViewController;

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

Route::get('/', [BasicViewController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/guide', function () {
    return view('guide');
});

Route::get('/cars', function () {
    return view('cars');
});

Route::get('/motors', function () {
    return view('motors');
});

Route::get('/help', function () {
    return view('help');
});

Route::get('/help', function () {
    return view('About');
});
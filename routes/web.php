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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [BasicViewController::class, 'getIndex'])->name('index');

Route::post('/subscribe', [BasicViewController::class, 'subscribe'])->name('email-subs');

Route::get('/guide', [BasicViewController::class, 'getGuide']);

Route::get('/rules', [BasicViewController::class, 'getRules']);

Route::get('/help', [BasicViewController::class, 'getHelp']);

Route::get('/about', [BasicViewController::class, 'getAbout']);

Route::get('/me/orders', [UserController::class, 'getUserOrders']);

Route::get('/me/profile', [UserController::class, 'getUserProfile']);

Route::get('/find/motor', [RentController::class, 'getFindVehicles']);

Route::get('/find/car', [RentController::class, 'getFindCar']);

Route::get('/rent/motors', [RentController::class, 'getRentMotors']);

Route::get('/rent/cars', [RentController::class, 'getRentCars']);

Route::middleware(['auth', 'verified'])-> group(function () {
    Route::get('/rent/car/{id}', [RentController::class, 'getRentCarForm']);
    Route::get('/rent/motor/{id}', [RentController::class, 'getRentMotorForm']);
});

Route::middleware(['auth', 'admin.authenticated'])-> group(function () {
    Route::get('/dashboard/customers', [AdminController::class, 'getCustomersDashboard']);
    Route::get('/dashboard/orders', [AdminController::class, 'getOrdersDashboard']);
    Route::get('/dashboard/vehicles', [AdminController::class, 'getVehiclesDashboard']);
});

Route::fallback([BasicViewController::class, 'fallback']);
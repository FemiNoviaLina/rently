<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicViewController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

Route::get('/me/orders', [RentController::class, 'getUserOrders'])->name('user-orders');

Route::get('/me/profile', [UserController::class, 'getUserProfile']);

Route::post('/me/profile', [UserController::class, 'updateProfile'])->name('update-profile');

Route::get('/find/motor', [RentController::class, 'getFindMotor'])->name('find-motor');

Route::get('/find/car', [RentController::class, 'getFindCar'])->name('find-car');

Route::get('/{type}', [RentController::class, 'findVehicles'])->where('type', '\b(motors|cars)\b');

Route::get('/rent/motors', [RentController::class, 'getRentMotors'])->name('rent-motors');

Route::get('/rent/cars', [RentController::class, 'getRentCars'])->name('rent-cars');

Route::get('/list/cars', [BasicViewController::class, 'getList']);

Route::middleware(['auth', 'verified'])-> group(function () {
    Route::get('/rent/car/{id}', [RentController::class, 'getRentForm']);
    Route::get('/rent/motor/{id}', [RentController::class, 'getRentForm']);
    Route::post('/rent/{type}/{id}', [RentController::class, 'rentVehicle'])->where('type', '\b(motor|car)\b');
});

Route::middleware(['auth', 'admin.authenticated'])-> group(function () {
    Route::get('/dashboard/customers', [AdminController::class, 'getCustomersDashboard']);
    Route::get('/dashboard/orders', [AdminController::class, 'getOrdersDashboard']);
    Route::get('/dashboard/vehicles', [AdminController::class, 'getVehiclesDashboard']);
});

Route::get('/test-up', function() {
    return view('test-up');
});

Route::post('/test-up', function(Request $request) {
    $path = $request->file('image')->storeAs(
        'images', 'example.png'
    );
});

Route::get('/uploaded', function() {
    return view('test-view');
});

Route::fallback([BasicViewController::class, 'fallback']);
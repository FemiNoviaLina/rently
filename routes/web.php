<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasicViewController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatsController;

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
    Route::get('/me/order/{id}/pay', [RentController::class, 'getPaymentDetails'])->name('payment-details');
    Route::get('/me/order/{id}/va', [RentController::class, 'getVirtualAccount'])->name('get-virtual-account');
    Route::get('/me/order/{id}/confirm', [RentController::class, 'getConfirmPayment'])->name('confirm-payment');
    Route::get('/me/order/{id}/check', [RentController::class, 'checkPayment'])->name('check-payment');
    Route::get('/message', [ChatsController::class, 'fetchMessage'])->name('fetch-message');
    Route::post('/message', [ChatsController::class, 'sendMessage'])->name('send-message');
});

Route::middleware(['auth', 'admin.authenticated'])-> group(function () {
    Route::get('/dashboard/customers', [AdminController::class, 'getCustomersDashboard'])->name('customers-dahboard');
    Route::get('/dashboard/orders', [AdminController::class, 'getOrdersDashboard'])->name('orders-dashboard');
    Route::get('/order-details/{id}', [AdminController::class, 'getOrderDetails'])->name('order-details');
    Route::get('/customer-details/{id}', [AdminController::class, 'getCustomerDetails'])->name('customer-details');
    Route::post('/dashboard/orders/acceptance/{id}', [AdminController::class, 'acceptOrder'])->name('accept-order');
    Route::post('/dashboard/orders/rejection/{id}', [AdminController::class, 'rejectOrder'])->name('reject-order');
    Route::get('/dashboard/vehicles/car', [AdminController::class, 'getVehiclesDashboardCar'])->name('vehicles-dashboard-car');
    Route::get('/dashboard/vehicles/motor', [AdminController::class, 'getVehiclesDashboardMotor'])->name('vehicles-dashboard-motor');
    Route::post('/dashboard/vehicles/car/done', [AdminController::class, 'doneVehicle'])->name('done-vehicle');
    Route::get('/dashboard/vehicles/car/new', [AdminController::class, 'getNewCarForm'])->name('add-car');
    Route::get('/dashboard/vehicles/motor/new', [AdminController::class, 'getNewMotorForm'])->name('add-motor');
    Route::get('/dashboard/vehicles/motor/{id}', [AdminController::class, 'updateMotorForm'])->name('update-motor');
    Route::get('/dashboard/vehicles/car/{id}', [AdminController::class, 'updateCarForm'])->name('update-car');
    Route::post('/dashboard/vehicles/{type}/new', [AdminController::class, 'addVehicle'])->name('add-vehicle')->where('type', '\b(car|motor)\b');
    Route::post('/dashboard/vehicles/{type}/delete', [AdminController::class, 'deleteVehicle'])->name('delete-vehicle')->where('type', '\b(car|motor)\b');
    Route::get('/dashboard/chats', [AdminController::class, 'getChatsDashboard'])->name('chats-dashboard')->name('chat-dashboard');
    Route::get('/dashboard/chats/get/{id}', [ChatsController::class, 'fetchAdminMessage'])->name('fetch-admin-message');
    Route::post('/dashboard/vehicles/{id}/update', [AdminController::class, 'updateVehicle'])->name('update-vehicle');
    Route::post('/dashboard/vehicles/{id}/update/image', [AdminController::class, 'updateVehicleImage'])->name('update-vehicle-image');
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
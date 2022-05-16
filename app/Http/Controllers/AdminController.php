<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Vehicle;

class AdminController extends Controller
{
    public function getCustomersDashboard()
    {
        return view('dashboard.customers');
    }

    public function getVehiclesDashboardCar()
    {
        $vehicles = Vehicle::where('type', '=', 'car')
        ->take(10)
        ->get();
        return view('dashboard.vehicles',  ['type' => 'Car', 'vehicles' => $vehicles]);
    }

    public function getVehiclesDashboardMotor()
    {
        $vehicles = Vehicle::where('type', '=', 'motor')
        ->take(10)
        ->get();
        return view('dashboard.vehicles',  ['type' => 'Motorcycles', 'vehicles' => $vehicles]);
    }

    public function getOrdersDashboard()
    {
        $selected = request()->input('selected') ? request()->input('selected') : 'All order';
        $take = request()->input('take') ? request()->input('take') : 10;

        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
        ->select('orders.id', 'orders.pickup_date', 'orders.pickup_time', 
        'orders.dropoff_date', 'orders.dropoff_time', 'orders.order_status', 'orders.total_price',
        'users.id as user_id', 'users.name as user_name', 'users.email', 
        'vehicles.name as vehicle_name', 'vehicles.id as vehicle_id')
        ->take($take)
        ->get();

        return view('dashboard.orders', ['selected' => $selected, 'orders' => $orders]);
    }

    public function acceptOrder($id) {
        $order = Order::find($id);
        $order->order_status = 'WAITING_FOR_PAYMENT';
        $order->save();

        return redirect()->route('orders-dashboard');
    }

    public function rejectOrder($id) {
        $order = Order::find($id);
        $order->order_status = 'REJECTED';
        $order->save();

        return redirect()->route('orders-dashboard');
    }
}

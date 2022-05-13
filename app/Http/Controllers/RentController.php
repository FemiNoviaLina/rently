<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;

use App\Models\Order;

class RentController extends Controller
{
    public function getFindCar()
    {
        return view('find-vehicles', ['type' => 'Car']);
    }

    public function findVehicles() {
        $request = request()->input();
        $type = $request['type'];

        $vehicles = Vehicle::join('orders', 'vehicles.id', '=', 'orders.vehicle_id')
        ->select("vehicles.id", "vehicles.name", "vehicles.brand_id", "vehicles.transmission", "vehicles.cc", "vehicles.price", "vehicles.type", "vehicles.photo", "vehicles.year")
        ->where("orders.dropoff_date", "<", $request['pickup_date'])
        ->orWhere("orders.pickup_date", ">", $request['dropoff_date'])
        ->groupBy("vehicles.id")
        ->having('vehicles.available_unit', '>', DB::raw('count(orders.id)'))
        ->get();

        return redirect()->route('rent-'. strtolower($type). 's', ['vehicles' => $vehicles]);
    }

    public function getFindMotor()
    {
        return view('find-vehicles');
    }

    public function getRentCarForm()
    {
        return view('rent-form');
    }

    public function getRentMotorForm()
    {
        return view('rent-form');
    }

    public function getRentCars()
    {
        return view('vehicles-list', ['vehicles' => session('vehicles'), 'type' => 'Car']);
    }

    public function getRentMotors()
    {
        return view('vehicles-list');
    }
}

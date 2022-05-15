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
        $pickup_date = $request['pickup_date'];
        $dropoff_date = $request['dropoff_date'];
        $transmission = isset($request['transmission']) ? $request['transmission'] : 'All';
        $brand = isset($request['brand']) ? $request['brand'] : 'All';

        $vehicles = Vehicle::leftJoin('orders', 'vehicles.id', '=', 'orders.vehicle_id')
        ->select("vehicles.id", "vehicles.name", "vehicles.brand", "vehicles.transmission", "vehicles.cc", "vehicles.fuel", "vehicles.price", "vehicles.type", "vehicles.photo", "vehicles.year")
        ->where("type", "=", $type)
        ->whereNull("orders.pickup_date")
        ->when($pickup_date && $dropoff_date, function($query) use ($pickup_date, $dropoff_date) {
                $query->orWhere("orders.dropoff_date", "<", $pickup_date)
                    ->orWhere("orders.pickup_date", ">", $dropoff_date);
        })
        ->when($brand != 'All', function($query, $brand) {
            $query->where('vehicles.brand', $brand);
        }) 
        ->when($transmission != 'All', function($query, $transmission) {
            $query->where('vehicles.transmission', $transmission);
        }) 
        ->groupBy("vehicles.id")
        ->having('vehicles.available_unit', '>', DB::raw('count(orders.id)'))
        ->get();

        return redirect()->route('rent-'. strtolower($type). 's')->with(['vehicles' => $vehicles, 'pickup_date' => $pickup_date, 'dropoff_date' => $dropoff_date]);
    }

    public function getFindMotor()
    {
        return view('find-vehicles', ['type' => 'Motor']);
    }

    public function getRentForm($id)
    {
        $vehicle = Vehicle::find($id);

        return view('rent-form', ['vehicle' => $vehicle]);
    }

    public function getRentCars()
    {
        if(!session('vehicles')) return redirect()->route(('find-car'));

        return view('vehicles-list', ['vehicles' => session('vehicles'), 'pickup_date' => session('pickup_date'), 'dropoff_date' => session('dropoff_date'), 'type' => 'Car']);
    }

    public function getRentMotors()
    {
        if(session('vehicles') == null) return redirect()->route(('find-motor'));

        return view('vehicles-list', ['vehicles' => session('vehicles'), 'pickup_date' => session('pickup_date'), 'dropoff_date' => session('dropoff_date'), 'type' => 'Motor']);
    }
}

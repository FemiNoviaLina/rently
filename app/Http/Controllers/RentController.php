<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Vehicle;

use App\Models\Order;

use DateTime;

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

    public function rentVehicle($type, $id)
    {
        $request = request()->input();

        $vehicle = Vehicle::find($id);

        $id_card_filename = $id . '_'.auth()->user()->id.'_id_card'. date('Y-m-d H-i-s'). '.' . request()->file('id_card')->getClientOriginalExtension();
        $id_card = request()->file('id_card')->storeAs('id-card', $id_card_filename);
        
        $id_card_2_filename = $id . '_'.auth()->user()->id.'_id_card_2'. date('Y-m-d H-i-s'). '.' . request()->file('id_card_2')->extension();
        $id_card_2 = request()->file('id_card_2')->storeAs('id-card', $id_card_2_filename, 'local');

        $driver_license_filename = $id . '_'.auth()->user()->id.'_driver_license'. date('Y-m-d H-i-s'). '.' . request()->file('driver_license')->extension();
        $driver_license = request()->file('driver_license')->storeAs('driver-license', $driver_license_filename, 'local');

        $pickup_day = new DateTime($request['dropoff_date']);
        $dropoff_day = new DateTime($request['pickup_date']);
        $rent_days = $pickup_day->diff($dropoff_day)->days;
        $rent_price = $rent_days * $vehicle->price;

        $data = [
            'vehicle_id' => $id,
            'user_id' => auth()->user()->id,
            'pickup_date' => $request['pickup_date'],
            'pickup_time' => $request['pickup_time'],
            'pickup_address' => $request['pickup_location'],
            'dropoff_date' => $request['dropoff_date'],
            'dropoff_time' => $request['dropoff_time'],
            'dropoff_address' => $request['dropoff_location'],
            'phone_1' => $request['phone_1'],
            'phone_2' => $request['phone_2'],
            'address_id' => $request['address_id'],
            'address_mlg' => $request['address_mlg'],
            'id_card' => $id_card_filename,
            'id_card_2' => $id_card_2_filename,
            'driver_license' => $driver_license_filename,
            'total_price' => $rent_price,
            'note' => $request['note'],
            'order_status' => 'PENDING',
        ];

        $order = Order::create($data);

        return redirect()->route('user-orders');
    }

    public function getUserOrders()
    {
        $orders = Order::join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
        ->select("orders.id", "orders.order_status", "orders.created_at", "vehicles.name")
        ->where('user_id', '=', auth()->user()->id)->get();

        return view('order-history', ['orders' => $orders]);
    }

    public function getPaymentDetails($id)
    {
        $method = request()->input('method') ? request()->input('method') : 'BCA Transfer';
        $order = Order::find($id);

        return view('payment-details', ['order' => $order, 'selected_method' => $method]);
    }
}

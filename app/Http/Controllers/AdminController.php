<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

use App\Models\User;
use App\Models\Order;
use App\Models\Vehicle;
use App\Models\Message;

class AdminController extends Controller
{
    public function getCustomersDashboard()
    {
        $take = request()->input('take') ? request()->input('take') : 10;
        $page = request()->input('page') ? request()->input('page') : 1;

        $customers = User::where('role', '=', 'user')
        ->select('id', 'name', 'email', 'phone_1', 'phone_2', 
        \DB::raw("case when (phone_1 IS NOT NULL AND phone_2 IS NOT NULL 
        AND address_id IS NOT NULL AND address_mlg IS NOT NULL) 
        then 'true' else 'false' end as completed"))
        ->take($take)
        ->skip(($page - 1) * $take)
        ->get();

        $total_data = User::where('role', '=', 'user')->count();

        return view('dashboard.customers', ['customers' => $customers, 'take' => $take, 'total_data' => $total_data, 'page' => $page]);
    }

    public function getVehiclesDashboardCar()
    {
        $take = request()->take ? request()->take : 10;
        $page = request()->page ? request()->page : 1;

        $vehicles = Vehicle::where('type', '=', 'car')
        ->take($take)
        ->skip(($page - 1) * $take)
        ->get();

        $total_data = Vehicle::where('type', '=', 'car')->count();
        return view('dashboard.vehicles',  ['type' => 'Car', 'vehicles' => $vehicles, 'take' => $take, 'total_data' => $total_data, 'page' => $page]);
    }

    public function getVehiclesDashboardMotor()
    {
        $take = request()->take ? request()->take : 10;
        $page = request()->page ? request()->page : 1;

        $vehicles = Vehicle::where('type', '=', 'motor')
        ->take($take)
        ->skip(($page - 1) * $take)
        ->get();

        $total_data = Vehicle::where('type', '=', 'motor')->count();
        return view('dashboard.vehicles',  ['type' => 'Motor', 'vehicles' => $vehicles, 'take' => $take, 'total_data' => $total_data, 'page' => $page]);
    }

    public function getOrdersDashboard()
    {
        $selected = request()->input('selected') ? request()->input('selected') : 'All order';
        $take = request()->input('take') ? request()->input('take') : 10;
        $page = request()->input('page') ? request()->input('page') : 1;

        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
        ->select('orders.id', 'orders.pickup_date', 'orders.pickup_time', 
        'orders.dropoff_date', 'orders.dropoff_time', 'orders.order_status', 'orders.total_price',
        'users.id as user_id', 'users.name as user_name', 'users.email', 
        'vehicles.name as vehicle_name', 'vehicles.id as vehicle_id')
        ->orderBy('orders.id', 'desc')
        ->when($selected == 'New order', function($query) {
            $query->Where('orders.order_status', 'PENDING');
        })
        ->when($selected == 'On process', function($query) {
            $query->Where('orders.order_status', 'WAITING_FOR_PAYMENT');
        })
        ->when($selected == 'On rent', function($query) {
            $query->Where('orders.order_status', 'PAYMENT_DONE');
        })
        ->when($selected == 'Completed', function($query) {
            $query->Where('orders.order_status', 'COMPLETED');
        })
        ->when($selected == 'Canceled', function($query) {
            $query->Where('orders.order_status', 'CANCELED');
        })
        ->take($take)
        ->skip(($page - 1) * $take)
        ->get();

        $total_data = Order::when($selected == 'New order', function($query) {
            $query->Where('orders.order_status', 'PENDING');
        })
        ->when($selected == 'On process', function($query) {
            $query->Where('orders.order_status', 'WAITING_FOR_PAYMENT');
        })
        ->when($selected == 'On rent', function($query) {
            $query->Where('orders.order_status', 'PAYMENT_DONE');
        })
        ->when($selected == 'Completed', function($query) {
            $query->Where('orders.order_status', 'COMPLETED');
        })
        ->when($selected == 'Canceled', function($query) {
            $query->Where('orders.order_status', 'CANCELED');
        })
        ->count();

        return view('dashboard.orders', ['selected' => $selected, 'orders' => $orders, 'take' => $take, 'total_data' => $total_data, 'page' => $page]);
    }

    public function getChatsDashboard() {
        $chatList = Message::join('users', 'messages.from_id', '=', 'users.id')
        ->select('users.id as user_id', 'users.name as user_name')
        ->distinct()
        ->get();

        return view('dashboard.chats', ['chatList' => $chatList]);
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
    
    public function doneVehicle() {
        $id = request()->order_id;
        $order = Order::find($id);

        $order->order_status = 'COMPLETED';
        $order->save();

        return redirect()->route('orders-dashboard');
    }

    public function getNewCarForm() {
        $type = 'Car';

        return view('dashboard.add-vehicle-form', ['type' => $type]);
    }

    public function getNewMotorForm() {
        $type = 'Motor';
        
        return view('dashboard.add-vehicle-form', ['type' => $type]);
    }

    public function addVehicle($type) {
        $request = request()->input();

        $photo_filename = $request['name']. '.' . request()->file('photo')->extension();
        $photo = request()->file('photo')->storeAs('images', $photo_filename, 'local');

        $data = [
            'name' => $request['name'],
            'brand' => $request['brand'],
            'type' => $type,
            'price' => $request['price'],
            'available_unit' => $request['available_unit'],
            'photo' => $photo_filename,
            'fuel' => $request['fuel'],
            'transmission' => $request['transmission'],
            'cc' => $request['cc'],
            'year' => $request['year'],
        ];

        $vehicle = Vehicle::create($data);

        return redirect()->route('vehicles-dashboard-'.$type);
    }

    public function getOrderDetails($id) {
        $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
        ->select('orders.id', 'orders.pickup_date', 'orders.pickup_time', 'orders.pickup_address', 
        'orders.dropoff_date', 'orders.dropoff_time', 'orders.dropoff_address', 'orders.phone_1',
        'orders.phone_2', 'orders.address_id', 'orders.address_mlg', 'orders.note', 'orders.order_status', 
        'orders.total_price', 'orders.id_card', 'orders.id_card_2', 'orders.driver_license',
        'orders.payment_method', 'orders.created_at', 'orders.transaction_id', 'orders.payment_expiry_time',
        'users.id as user_id', 'users.name as user_name', 'users.email', 
        'vehicles.id as vehicles_id', 'vehicles.name as vehicle_name', 'vehicles.type',
        'vehicles.price', 'vehicles.available_unit', 'vehicles.photo', 'vehicles.fuel', 'vehicles.transmission',
        'vehicles.cc', 'vehicles.year')
        ->where('orders.id', '=', $id)
        ->get();

        return response()->json($orders);
    }

    public function getCustomerDetails($id) {
        $customer = User::select('id', 'name', 'email', 'phone_1', 'phone_2', 'address_id', 'address_mlg')
        ->where('id', '=', $id)
        ->first();

        $orders = Order::join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
        ->select('orders.id as order_id', 'orders.order_status', 'vehicles.name as vehicle_name')
        ->where('orders.user_id', '=', $id)
        ->orderBy('orders.id', 'desc')
        ->get();

        return response()->json(['customer' => $customer, 'orders' => $orders]);
    }

    public function deleteVehicle() {
        try {
            $ids = request()->input('ids');

            $vehicles = Vehicle::whereIn('id', $ids)->get();

            foreach($vehicles as $vehicle) {
                $deleted = Storage::delete('images/'.$vehicle->photo);
                if($deleted) $vehicle->delete();
            }
            return response()->json(['success' => true, 'type' => 'car']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'type' => 'car']);
        }
    }

    public function updateMotorForm($id) {
        $vehicle = Vehicle::find($id);

        return view('dashboard.update-vehicle-form', ['vehicle' => $vehicle, 'type' => 'Motor']);
    }

    public function updateCarForm($id) {
        $vehicle = Vehicle::find($id);

        return view('dashboard.update-vehicle-form', ['vehicle' => $vehicle, 'type' => 'Car']);
    }

    public function updateVehicle($id) {
        $request = request()->input();

        $vehicle = Vehicle::find($id);

        $vehicle->name = $request['name'];
        $vehicle->brand = $request['brand'];
        $vehicle->price = $request['price'];
        $vehicle->available_unit = $request['available_unit'];
        $vehicle->fuel = $request['fuel'];
        $vehicle->transmission = $request['transmission'];
        $vehicle->cc = $request['cc'];
        $vehicle->year = $request['year'];

        $vehicle->save();
        return redirect()->route('vehicles-dashboard-'. request()->input('type'));
    }
    
    public function updateVehicleImage($id) {
        try {
            $request = request()->input();

            $vehicle = Vehicle::find($id);

            $deleted = Storage::delete('images/'.$vehicle->photo);
            if(!$deleted) throw new \Exception('Failed to delete old image');

            $photo_filename = $vehicle->name. '.' . request()->file('photo')->extension();
            $photo = request()->file('photo')->storeAs('images', $photo_filename, 'local');

            $vehicle->photo = $photo_filename;
            $vehicle->save();

            return redirect()->route('update-'. $vehicle->type, ['id' => $id]);
        } catch(e) {
            Session::flash('error', 'Failed to update vehicle image');
            return redirect()->route('update'. $vehicle->type);
        }
    }
}

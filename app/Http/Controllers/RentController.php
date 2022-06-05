<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;

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
        ->where("vehicles.type", '=' , strtolower($type))
        ->when($brand != 'All', function($query) use ($brand) {
            $query->Where('vehicles.brand', '=', $brand);
        }) 
        ->when($transmission != 'All', function($query) use ($transmission) {
            $query->Where('vehicles.transmission', '=', $transmission);
        })
        ->groupBy("vehicles.id")
        ->having('vehicles.available_unit', '>', DB::raw("count(orders.id) FILTER(WHERE ORDERS.DROPOFF_DATE >= '$dropoff_date' AND ORDERS.PICKUP_DATE >= '$pickup_date' AND ORDERS.ORDER_STATUS NOT IN ('DONE', 'CANCELLED'))"))
        ->get();

        return redirect()->route('rent-'. strtolower($type). 's')->with(['vehicles' => $vehicles, 'pickup_date' => $pickup_date, 'dropoff_date' => $dropoff_date, 'transmission' => $transmission, 'brand' => $brand]);
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

        return view('vehicles-list', ['vehicles' => session('vehicles'), 'pickup_date' => session('pickup_date'), 'dropoff_date' => session('dropoff_date'), 'type' => 'Car', 'transmission' => session('transmission'), 'brand' => session('brand')]);
    }

    public function getRentMotors()
    {
        if(session('vehicles') == null) return redirect()->route(('find-motor'));

        return view('vehicles-list', ['vehicles' => session('vehicles'), 'pickup_date' => session('pickup_date'), 'dropoff_date' => session('dropoff_date'), 'type' => 'Motor', 'transmission' => session('transmission'), 'brand' => session('brand')]);
    }

    public function rentVehicle($type, $id, Request $request)
    {

        // $request = $request->validate([
        //     'pickup_date' => 'required|before_or_equal:dropoff_date|after_or_equal:today',
        //     'pickup_time' => 'required',
        //     'dropoff_date' => 'required|after_or_equal:pickup_date',
        //     'dropoff_time' => 'required',
        //     'vehicle_id' => 'required',
        //     'user_id' => 'required',
        //     'pickup_address' => 'required',
        //     'dropoff_address' => 'required',
        //     'phone_1' => 'required',
        //     'phone_2' => 'required',
        //     'address_id' => 'required',
        //     'address_mlg' => 'required',
        //     'id_card' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        //     'id_card_2' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        //     'driver_license' => 'required|image|mimes:jpeg,png,jpg,pdf|max:2048',
        //     'note' => 'nullable',
        // ]);

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
        $rent_price = ($rent_days * $vehicle->price) + 4500;

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
        ->where('user_id', '=', auth()->user()->id)
        ->orderBy('orders.created_at', 'desc')
        ->get();

        return view('order-history', ['orders' => $orders]);
    }

    public function getPaymentDetails($id)
    {
        $method = request()->input('method') ? request()->input('method') : 'BCA Transfer';
        $order = Order::join('vehicles', 'orders.vehicle_id', '=', 'vehicles.id')
        ->select("orders.id", "orders.order_status", "orders.created_at", "vehicles.name", "orders.total_price", "orders.transaction_id")
        ->where('orders.id', '=', $id)
        ->first();

        if($order->transaction_id) {
            return redirect()->route('confirm-payment', [$order->id])->with('order', $order);
        }

        return view('payment-details', ['order' => $order, 'selected_method' => $method]);
    }

    public function getVirtualAccount($id)
    {
        $method = request()->input('method');
        $order = Order::find($id);

        $AUTH_STRING = "Basic " . base64_encode(env('MIDTRANS_SERVER_KEY') . ":");

        $payment_type = array(
            "BCA Transfer" => "bank_transfer",
            "BNI Transfer" => "bank_transfer",
            "BRI Transfer" => "bank_transfer",
            "Mandiri Transfer" => "echannel",
            "Permata Transfer" => "permata",
            "Shopee Pay" => "gopay",
            "Dana" => "gopay",
            "OVO" => "gopay",
            "GoPay" => "gopay"
        );

        $req_body = [
            "payment_type" => $payment_type[$method],
            "transaction_details" => [
                "order_id" => $order->id,
                "gross_amount" => $order->total_price,
            ]
        ];

        if($payment_type[$method] == 'bank_transfer') {
            $req_body['bank_transfer']['bank'] = explode(' ', strtolower($method))[0];
        }

        if($payment_type[$method] == 'echannel') {
            $req_body['echannel']['bill_info1'] = $order->id;
            $req_body['echannel']['bill_info2'] = $order->total_price;
        }
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $AUTH_STRING
        ])
        ->withBody(json_encode($req_body), 'application/json')
        ->post('https://api.sandbox.midtrans.com/v2/charge');

        $response = $response->json();

        if($response['status_code'] == '201') {
            if($payment_type[$method] == 'bank_transfer') {
                $order->virtual_account = $response['va_numbers'][0]['va_number'];
            } else if ($payment_type[$method] == 'echannel') {
                $order->virtual_account = $response['bill_key'] . ' ' . $response['bill_code'];
            } else if ($payment_type[$method] == 'gopay') {
                $order->qr_link = $response['actions'][0]['url'];
                $order->deep_link = $response['actions'][1]['url'];
            } else {
                $order->virtual_account = $response->json()['permata_va_number'];
            } 

            $order->transaction_id = $response['transaction_id'];
            $payment_expiry_time = new DateTime();
            $payment_expiry_time->modify('+1 day');
            $order->payment_expiry_time = $payment_expiry_time->format('Y-m-d H:i:s');
            $order->payment_method = $method;
        }
        
        $order->save();

        if($order->transaction_id) {
            return redirect()->route('confirm-payment', ['id' => $order->id]);
        } else {
            return redirect()->route('payment-details', ['id' => $order->id])->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function getConfirmPayment($id)
    {
        $order = Order::find($id);

        if($order->transaction_id) {
            return view('confirm-payment', ['order' => $order]);
        } else {
            return redirect()->route('payment-details', ['id' => $order->id]);
        }
    }

    public function checkPayment($id) {
        $order = Order::find($id);

        $AUTH_STRING = "Basic " . base64_encode(env('MIDTRANS_SERVER_KEY') . ":");

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $AUTH_STRING
        ])
        ->get('https://api.sandbox.midtrans.com/v2/' . $order->transaction_id . '/status');

        $response = $response->json();
        
        if($response['status_code'] == '200') {
            if($response['transaction_status'] == 'settlement') {
                $order->order_status = 'PAYMENT_DONE';
            }
        }

        $order->save();

        return redirect()->route('user-orders');
    }
    
    public function paymentNotification() {
        $notif = request()->input();

        $transaction = $notif['transaction_status'];
        $type = $notif['payment_type'];
        $transaction_id = $notif['transaction_id'];
        $fraud = $notif['fraud_status'];

        $order = Order::where('transaction_id', '=', $transaction_id)->first();

        if ($transaction == 'settlement') {
            $order->order_status = 'PAYMENT_DONE';
        }
        else if($transaction == 'pending') {
            $order->order_status = 'WAITING_FOR_PAYMENT';
        }
        else if ($transaction == 'deny') {
            $order->order_status = 'REJECTED';
        }
        else if ($transaction == 'expire') {
            $order->order_status = 'CANCELED';
        }
        else if ($transaction == 'cancel') {
            $order->order_status = 'CANCELED';
        }

        $order->save();
        return response()->noContent();
    }
}

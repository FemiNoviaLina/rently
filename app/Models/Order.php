<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'pickup_date',
        'pickup_time',
        'pickup_address',
        'dropoff_date',
        'dropoff_time',
        'dropoff_address',
        'total_price',
        'order_status',
        'phone_1',
        'phone_2',
        'address_id',
        'address_mlg',
        'id_card',
        'id_card_2',
        'driver_license',
        'note'
    ];
}

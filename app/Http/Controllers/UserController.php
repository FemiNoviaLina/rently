<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserProfile()
    {
        return view('user-profile');
    }

    public function getUserOrders()
    {
        return view('order-history');
    }
}

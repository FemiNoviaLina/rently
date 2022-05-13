<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getCustomersDashboard()
    {
        return view('dashboard.customers');
    }

    public function getVehiclesDashboard()
    {
        return view('dashboard.vehicles');
    }

    public function getOrdersDashboard()
    {
        return view('dashboard.orders');
    }
}

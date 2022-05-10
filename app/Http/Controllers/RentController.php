<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentController extends Controller
{
    public function carFormView() {
        return view('rent-form');
    }
}

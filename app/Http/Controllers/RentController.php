<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RentController extends Controller
{
    public function getFindCar()
    {
        return view('find-vehicles');
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
        return view('vehicles-list');
    }

    public function getRentMotors()
    {
        return view('vehicles-list');
    }
}

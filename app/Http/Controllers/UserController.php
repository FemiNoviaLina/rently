<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserProfile()
    {
        return view('user-profile');
    }

    public function updateProfile()
    {
        $request = request()->input();

        $user = auth()->user();

        $user->phone_1 = $request['phone_1'];
        $user->phone_2 = $request['phone_2'];
        $user->address_id = $request['address_id'];
        $user->address_mlg = $request['address_mlg'];
        $user->save();

        return redirect()->route('index');
    }
}

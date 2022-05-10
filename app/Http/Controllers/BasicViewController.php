<?php

namespace App\Http\Controllers;
use App\Models\Review;

use Illuminate\Http\Request;

class BasicViewController extends Controller
{
    public function index()
    {
        $reviews = Review::all()
            ->sortByDesc('created_at')
            ->take(4)
            ->get();

        return view('welcome', ['reviews' => $reviews]);
    }

    public function guide()
    {
        return view('guide');
    }

    public function cars()
    {
        return view('cars');
    }
}

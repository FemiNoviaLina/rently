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
            ->take(4);

        return view('welcome', ['reviews' => $reviews]);
    }

    public function fallback()
    {
        abort(404);
    }

    public function guide()
    {
        return view('guide');
    }

    public function cars()
    {
        return view('cars');
    }

    public function motors()
    {
        return view('motors');
    }

    public function help()
    {
        return view('help');
    }

    public function about()
    {
        return view('about');
    }
}

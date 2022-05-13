<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\SubscriptionEmail;

use Illuminate\Http\Request;

class BasicViewController extends Controller
{
    public function getIndex()
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

    public function getGuide()
    {
        return view('guide');
    }

    public function getRules()
    {
        return view('rules');
    }

    public function getHelp()
    {
        return view('help');
    }

    public function getAbout()
    {
        return view('about');
    }

    public function subscribe() {
        $email = request()->input('email');
        $subscription = SubscriptionEmail::firstOrCreate(['email' => $email]);

        $redirect_url = request()->header('referer');

        return redirect($redirect_url);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home1()
    {
        return view('home1');
    }

    public function home2()
    {
        if (!Auth::check()) {
            return redirect()->route('home1');
        }

        $user = Auth::user();
        $userEvents = $user->events ?? collect();

        return view('home2', compact('user', 'userEvents'));
    }
}

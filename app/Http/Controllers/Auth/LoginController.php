<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $user = auth()->user();

        if ($user->role === 'god') {
            return redirect()->route('god.dashboard');
        }

        return redirect()->route('home2');
    }

    return back()->withErrors(['email' => 'Credenciais inválidas']);
}

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('home1');
    }
    protected function redirectTo()
{
    $user = auth()->user();

    if ($user->role === 'god') {
        return '/god-dashboard';
    }   

    return '/home2';
}
}

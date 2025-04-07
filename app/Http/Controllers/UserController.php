<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Exibe o formulário de registro
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Processa o registro de usuário
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Garante que a senha seja criptografada
        ]);

        // Autentica o usuário imediatamente após o registro
        Auth::login($user);

        // Redireciona o usuário para home2 e exibe mensagem de sucesso
        return redirect()->route('home2')->with('success', 'Account created successfully!');
    }

    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Processa o login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Redireciona para home2 e exibe mensagem de sucesso
            return redirect()->route('home2')->with('success', 'Login successful!');
        }

        // Retorna erro se as credenciais forem inválidas
        return back()->withErrors(['email' => 'E-mail ou senha inválidos'])->withInput();
    }

    // Processa o logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home1')->with('success', 'You have been logged out.');
    }
}

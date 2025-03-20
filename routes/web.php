<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GroupController;

// Página inicial (Home1 para visitantes)
Route::get('/', [HomeController::class, 'home1'])->name('home1');

// Dashboard do usuário logado (Home2)
Route::middleware(['auth'])->group(function () {
    Route::get('/home2', [HomeController::class, 'home2'])->name('home2');
});

// About Us e Contact Us (públicas)
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Página de Registro
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Criação de Grupos (somente usuários logados)
Route::middleware(['auth'])->group(function () {
    Route::get('/create-group', [GroupController::class, 'showCreateGroupForm'])->name('create.group');
    Route::post('/create-group', [GroupController::class, 'store'])->name('create.group.post');
});

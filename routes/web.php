<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupInvitationController;

// Página inicial (Home1 para visitantes)
Route::get('/', [HomeController::class, 'home1'])->name('home1');

// Dashboard do usuário logado (Home2)
Route::middleware(['auth'])->group(function () {
    Route::get('/home2', [HomeController::class, 'home2'])->name('home2');
});

// About Us e Contact Us (públicas)
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');

// Página de Registro
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.post');

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Grupo e Criação de Eventos (somente usuários logados)
Route::middleware(['auth'])->group(function () {
    // Página de criação de grupos
    Route::get('/create-group', [GroupController::class, 'create'])->name('create.group');
    Route::post('/create-group', [GroupController::class, 'store'])->name('create.group.post');

    // Convites para grupos
    Route::post('/group/{groupId}/invite', [GroupInvitationController::class, 'invite'])->name('group.invite');
    Route::post('/group/invitation/{invitationId}/accept', [GroupInvitationController::class, 'accept'])->name('group.invitation.accept');
    Route::post('/group/invitation/{invitationId}/decline', [GroupInvitationController::class, 'decline'])->name('group.invitation.decline');
});

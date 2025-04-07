<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupInvitationController;
use App\Http\Controllers\GodController;

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

// rota para GOD

Route::middleware(['auth', 'is_god'])->group(function () {
    Route::get('/god-dashboard', [GodController::class, 'index'])->name('god.dashboard');
});
// Grupo de rotas para o GOD
Route::middleware(['auth', 'is_god'])->prefix('god')->group(function () {
    Route::get('/dashboard', [GodController::class, 'index'])->name('god.dashboard');

    // Ações dos usuários
    Route::get('/user/{id}/edit', [GodController::class, 'editUser'])->name('god.user.edit');
    Route::post('/user/{id}/update', [GodController::class, 'updateUser'])->name('god.user.update');
    Route::delete('/user/{id}/delete', [GodController::class, 'deleteUser'])->name('god.user.delete');
    Route::post('/user/{id}/change-role', [GodController::class, 'changeUserRole'])->name('god.user.role');
    // / Ações dos eventos
Route::get('/event/{id}/edit', [GodController::class, 'editEvent'])->name('god.event.edit');
Route::post('/event/{id}/update', [GodController::class, 'updateEvent'])->name('god.event.update');
Route::delete('/event/{id}/delete', [GodController::class, 'deleteEvent'])->name('god.event.delete');
Route::get('/event/{id}/participants', [GodController::class, 'viewParticipants'])->name('god.event.participants');
});
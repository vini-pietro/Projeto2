<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Importa o model User
use App\Models\Group;
use App\Models\Event;

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
        $userEvents = Event::where('user_id', $user->id)->get(); // Obtém os eventos do usuário
        $userGroups = $user->groups ?? collect([]); // Obtém os grupos do usuário
        $pendingInvitations = $user->receivedInvitations ?? collect([]); // Convites pendentes
    
        return view('home2', compact('user', 'userEvents', 'userGroups', 'pendingInvitations'));
    }
}

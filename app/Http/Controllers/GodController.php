<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;

class GodController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        $eventos = Group::with('users')->get();

        return view('god.dashboard', compact('usuarios', 'eventos'));
    }

public function editUser($id)
{
    $user = User::findOrFail($id);
    return view('god.edit-user', compact('user'));
}

public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);
    return redirect()->route('god.dashboard')->with('success', 'Usuário atualizado com sucesso.');
}

public function deleteUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('god.dashboard')->with('success', 'Usuário excluído com sucesso.');
}

public function changeUserRole(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->role = $request->role;
    $user->save();
    return redirect()->route('god.dashboard')->with('success', 'Role do usuário alterada com sucesso.');
}
public function editEvent($id)
{
    $event = \App\Models\Group::findOrFail($id);
    return view('god.edit-event', compact('event'));
}

public function updateEvent(Request $request, $id)
{
    $event = \App\Models\Group::findOrFail($id);
    $event->update([
        'name' => $request->name,
        'description' => $request->description,
        'date' => $request->date,
        'location' => $request->location
    ]);
    return redirect()->route('god.dashboard')->with('success', 'Evento atualizado com sucesso.');
}

public function deleteEvent($id)
{
    $event = \App\Models\Group::findOrFail($id);
    $event->delete();
    return redirect()->route('god.dashboard')->with('success', 'Evento excluído com sucesso.');
}

public function viewParticipants($id)
{
    $evento = \App\Models\Group::with('users')->findOrFail($id);
    return view('god.participants', compact('evento'));
}
}

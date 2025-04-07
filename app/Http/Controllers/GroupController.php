<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function create()
    {
        $users = User::all(); // Obtém todos os usuários cadastrados para seleção
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'participants' => 'array',
        ]);

        // Criar o grupo associado ao usuário logado
        $group = Group::create([
            'name' => $request->name,
            'date' => $request->date,
            'location' => $request->location,
            'description' => $request->description,
            'owner_id' => auth()->id(), // Define o usuário atual como dono do grupo
        ]);

        // Adiciona o criador ao grupo automaticamente
        $group->users()->attach(auth()->id());

        // Adiciona os participantes ao grupo, se houver
        if ($request->has('participants')) {
            $group->users()->attach($request->participants);
        }

        // Define uma mensagem de sucesso na sessão e redireciona corretamente
        return redirect()->route('home2')->with('success', 'Your event was successfully created! 🎉');
    }
}

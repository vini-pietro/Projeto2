<?php

namespace App\Http\Controllers;

use App\Models\GroupInvitation;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupInvitationController extends Controller
{
    public function invite(Request $request, $groupId)
    {
        $request->validate(['receiver_id' => 'required|exists:users,id']);

        $group = Group::findOrFail($groupId);

        if ($group->owner_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Apenas o dono do grupo pode convidar membros.');
        }

        GroupInvitation::create([
            'group_id' => $groupId,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Convite enviado com sucesso!');
    }

    public function accept($invitationId)
    {
        $invitation = GroupInvitation::findOrFail($invitationId);

        if ($invitation->receiver_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Você não pode aceitar este convite.');
        }

        $invitation->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Convite aceito!');
    }

    public function decline($invitationId)
    {
        $invitation = GroupInvitation::findOrFail($invitationId);

        if ($invitation->receiver_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Você não pode recusar este convite.');
        }

        $invitation->update(['status' => 'declined']);

        return redirect()->back()->with('success', 'Convite recusado.');
    }
}

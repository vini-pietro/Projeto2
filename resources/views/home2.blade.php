@extends('layouts.app')

@section('content')

<!-- Mensagem de Sucesso -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container mt-5">
    <h1>Welcome back, {{ auth()->user()->name ?? 'Usuário' }}!</h1>
    <p>This is your dashboard.</p>

    <!-- Botão para criar evento corretamente -->
    <a href="{{ route('create.group') }}" class="btn btn-warning mt-3">New Party!</a>

    <!-- Listagem dos grupos do usuário -->
    <h3 class="mt-4">Your Groups:</h3>
    <ul class="list-group">
        @forelse($userGroups as $group)
            <li class="list-group-item">{{ $group->name }}</li>
        @empty
            <li class="list-group-item">You are not in any group.</li>
        @endforelse
    </ul>

    <!-- Listagem dos eventos do usuário -->
    <h3 class="mt-4">Your Events:</h3>
    <ul class="list-group">
        @forelse($userEvents as $event)
            <li class="list-group-item">{{ $event->name }} - {{ $event->date->format('d/m/Y') }}</li>
        @empty
            <li class="list-group-item">No events found</li>
        @endforelse
    </ul>

    <!-- Listagem de convites pendentes -->
    <h3 class="mt-4">Pending Invitations:</h3>
    <ul class="list-group">
        @forelse(auth()->user()->receivedInvitations as $invitation)
            <li class="list-group-item">
                Invitation to <strong>{{ $invitation->group->name }}</strong> from {{ $invitation->sender->name }}
                
                <form action="{{ route('group.invitation.accept', $invitation->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">Accept</button>
                </form>

                <form action="{{ route('group.invitation.decline', $invitation->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                </form>
            </li>
        @empty
            <li class="list-group-item">No pending invitations</li>
        @endforelse
    </ul>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Participantes do Evento: {{ $evento->name }}</h3>

    <ul class="list-group">
        @forelse($evento->users as $user)
            <li class="list-group-item">
                {{ $user->name }} — {{ $user->email }}
            </li>
        @empty
            <li class="list-group-item">Nenhum participante.</li>
        @endforelse
    </ul>

    <a href="{{ route('god.dashboard') }}" class="btn btn-primary mt-3">Voltar</a>
</div>
@endsection

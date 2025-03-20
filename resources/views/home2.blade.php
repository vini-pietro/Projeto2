@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Welcome back, {{ auth()->user()->name ?? 'Usuário' }}!</h1>
    <p>This is your dashboard.</p>

    <a href="{{ route('create.group') }}" class="btn btn-warning mt-3">New party!</a>

    <h3 class="mt-4">Seus Grupos:</h3>
    <ul class="list-group">
        <!-- Aqui depois vamos listar os grupos do usuário -->
        <li class="list-group-item">Grupo Exemplo 1</li>
        <li class="list-group-item">Grupo Exemplo 2</li>
    </ul>
</div>
<div>
<h3>Seus Eventos:</h3>
<ul class="list-group">
    @if(isset($userEvents) && count($userEvents) > 0)
        @foreach($userEvents as $event)
            <li class="list-group-item">{{ $event->name }}</li>
        @endforeach
    @else
        <li class="list-group-item">Nenhum evento encontrado</li>
    @endif
</ul>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Painel GOD 👑</h2>

    {{-- Usuários --}}
    <div class="card mb-5">
        <div class="card-header">
            <strong>Usuários do Sistema</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                            <a href="{{ route('god.user.edit', $user->id) }}" class="btn btn-sm btn-primary">Editar</a>

<form action="{{ route('god.user.delete', $user->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
</form>

<form action="{{ route('god.user.role', $user->id) }}" method="POST" style="display:inline-block;">
    @csrf
    <input type="hidden" name="role" value="{{ $user->role === 'user' ? 'admin' : 'user' }}">
    <button type="submit" class="btn btn-sm btn-primary">Mudar Role</button>
</form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Eventos --}}
    <div class="card">
        <div class="card-header">
            <strong>Eventos Criados</strong>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome do Evento</th>
                        <th>Data</th>
                        <th>Criado por</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventos as $evento)
                        <tr>
                            <td>{{ $evento->name }}</td>
                            <td>{{ $evento->date }}</td>
                            <td>{{ $evento->users->first()->name ?? 'Desconhecido' }}</td>
                            <td>
                            <a href="{{ route('god.event.edit', $evento->id) }}" class="btn btn-sm btn-primary">Editar</a>

<form action="{{ route('god.event.delete', $evento->id) }}" method="POST" style="display:inline-block;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
</form>

<a href="{{ route('god.event.participants', $evento->id) }}" class="btn btn-sm btn-primary">Ver Participantes</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div><br>
@endsection

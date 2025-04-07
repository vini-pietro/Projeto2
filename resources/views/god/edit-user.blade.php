@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar Usuário</h3>

    <form action="{{ route('god.user.update', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('god.dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

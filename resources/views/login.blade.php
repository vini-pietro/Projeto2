@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
@endsection

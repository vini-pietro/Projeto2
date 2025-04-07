@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Editar Evento</h3>

    <form action="{{ route('god.event.update', $event->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="description" class="form-control">{{ $event->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Data</label>
            <input type="date" name="date" class="form-control" value="{{ $event->date }}" required>
        </div>

        <div class="mb-3">
            <label>Localização</label>
            <input type="text" name="location" class="form-control" value="{{ $event->location }}">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('god.dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

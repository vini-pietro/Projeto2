@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Create a New Party</div>
                <div class="card-body">
                    <form action="{{ route('create.group.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="event_image" class="form-label">Upload Event Image</label>
                            <input type="file" class="form-control" id="event_image" name="event_image" accept="image/*">
                        </div>
                        
                        <!-- Nome do evento (Corrigido) -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Event Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        
                        <!-- Data (Corrigido) -->
                        <div class="mb-3">
                            <label for="date" class="form-label">Event Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        
                        <!-- Localização (Corrigido) -->
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        
                        <!-- Participantes -->
                        <div class="mb-3">
                            <label for="participants" class="form-label">Participants</label>
                            <select class="form-control" name="participants[]" id="participants" multiple>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold CTRL (Windows) / CMD (Mac) to select multiple participants</small>
                        </div>
                        
                        <!-- Descrição (Corrigido) -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        
                        <!-- Botão de Enviar -->
                        <button type="submit" class="btn btn-success">Create Party</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><br>
@endsection

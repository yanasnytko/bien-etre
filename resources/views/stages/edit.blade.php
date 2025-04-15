@extends('layouts.app')

@section('content')
    <h2>Modifier le Stage</h2>

    <form action="{{ route('stages.update', $stage->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $stage->name }}" required>
        </div>
        <!-- Autres champs de modification -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection

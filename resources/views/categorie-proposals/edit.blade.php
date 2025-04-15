@extends('layouts.app')

@section('content')
    <h2>Modifier la Proposition</h2>

    <form action="{{ route('categorie-proposals.update', $proposal->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="proposed_name" class="form-label">Nom proposé</label>
            <input type="text" name="proposed_name" id="proposed_name" class="form-control" value="{{ $proposal->proposed_name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $proposal->description }}</textarea>
        </div>
        <!-- Tu peux aussi gérer le champ status si nécessaire -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection

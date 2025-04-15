@extends('layouts.app')

@section('content')
    <h2>Détails du Stage</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $stage->name }}</h3>
            <p>{{ $stage->description }}</p>
            <p><strong>Date de début :</strong> {{ $stage->date_start }}</p>
            <p><strong>Date de fin :</strong> {{ $stage->date_end }}</p>
            <!-- Affiche d'autres informations -->
        </div>
    </div>

    <a href="{{ route('stages.edit', $stage->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('stages.destroy', $stage->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
    </form>
    <a href="{{ route('stages.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection

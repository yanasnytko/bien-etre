@extends('layouts.app')

@section('content')
    <h2>Détails de la Proposition</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $proposal->proposed_name }}</h3>
            <p>{{ $proposal->description }}</p>
            <p><strong>Status :</strong> {{ $proposal->status }}</p>
        </div>
    </div>

    <a href="{{ route('categorie-proposals.edit', $proposal->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('categorie-proposals.destroy', $proposal->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
    </form>
    <a href="{{ route('categorie-proposals.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection

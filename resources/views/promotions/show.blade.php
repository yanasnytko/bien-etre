@extends('layouts.app')

@section('content')
    <h2>Détails de la Promotion</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $promotion->title }}</h3>
            <p>{{ $promotion->description }}</p>
            <!-- Affiche d'autres informations selon les besoins -->
        </div>
    </div>

    <a href="{{ route('promotions.edit', $promotion->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
    </form>
    <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection

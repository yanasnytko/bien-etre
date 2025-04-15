@extends('layouts.app')

@section('content')
    <h2>Détails de la Catégorie</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $service->name }}</h3>
            <p>{{ $service->description }}</p>
        </div>
    </div>

    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('services.destroy', $service->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
    </form>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection

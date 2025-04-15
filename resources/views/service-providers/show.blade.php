@extends('layouts.app')

@section('content')
    <h2>Détails du Prestataire</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $serviceProvider->company_name }}</h3>
            <p><strong>Email:</strong> {{ $serviceProvider->company_email }}</p>
            <p><strong>Description:</strong> {{ $serviceProvider->description }}</p>
            <!-- Affiche d'autres informations si nécessaire -->
        </div>
    </div>

    @can('update', $serviceProvider)
        <a href="{{ route('service-providers.edit', $serviceProvider->id) }}" class="btn btn-warning">Modifier</a>
    @endcan

    <form action="{{ route('service-providers.destroy', $serviceProvider->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
    </form>

    <a href="{{ route('service-providers.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection

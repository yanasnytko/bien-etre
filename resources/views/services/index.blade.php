@extends('layouts.app')

@section('content')
    <h2>Liste des Catégories</h2>

    @if($services->isNotEmpty())
        <ul class="list-group">
            @foreach($services as $service)
                <li class="list-group-item">
                    <a href="{{ route('services.show', $service->id) }}">{{ $service->name }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune catégorie trouvée.</p>
    @endif

    <a href="{{ route('services.create') }}" class="btn btn-primary mt-3">Ajouter une Catégorie</a>
@endsection

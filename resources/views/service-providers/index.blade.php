@extends('layouts.app')

@section('content')
    <h2>Liste des Prestataires</h2>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($serviceProviders->isNotEmpty())
        <ul class="list-group">
            @foreach($serviceProviders as $provider)
                <li class="list-group-item">
                    <a href="{{ route('service-providers.show', $provider->id) }}">
                        {{ $provider->company_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucun prestataire trouvé.</p>
    @endif

    <a href="{{ route('service-providers.create') }}" class="btn btn-primary mt-3">Ajouter un Prestataire</a>
@endsection

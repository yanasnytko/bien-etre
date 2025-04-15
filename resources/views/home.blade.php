@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h2>Bienvenue sur l'annuaire Bien-Être</h2>
        <p>Recherchez le prestataire qui répond à vos besoins.</p>
    </div>

    <form action="{{ route('service-providers.index') }}" method="GET">
        <div class="mb-3">
            <input type="text" name="search" placeholder="Rechercher..." class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
@endsection

@extends('layouts.app')

@section('content')
    <h2>Proposer une Nouvelle Catégorie</h2>

    <form action="{{ route('categorie-proposals.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="proposed_name" class="form-label">Nom proposé</label>
            <input type="text" name="proposed_name" id="proposed_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description (optionnelle)</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <!-- Le champ status est généralement défini automatiquement à 'pending' -->
        <button type="submit" class="btn btn-success">Envoyer la Proposition</button>
    </form>
@endsection

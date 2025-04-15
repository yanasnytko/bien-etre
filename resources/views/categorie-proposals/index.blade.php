@extends('layouts.app')

@section('content')
    <h2>Propositions de Catégories</h2>

    @if($proposals->isNotEmpty())
        <ul class="list-group">
            @foreach($proposals as $proposal)
                <li class="list-group-item">
                    <a href="{{ route('categorie-proposals.show', $proposal->id) }}">{{ $proposal->proposed_name }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune proposition trouvée.</p>
    @endif

    <a href="{{ route('categorie-proposals.create') }}" class="btn btn-primary mt-3">Proposer une Catégorie</a>
@endsection

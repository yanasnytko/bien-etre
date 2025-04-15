@extends('layouts.app')

@section('content')
    <h2>Liste des Promotions</h2>

    @if($promotions->isNotEmpty())
        <ul class="list-group">
            @foreach($promotions as $promotion)
                <li class="list-group-item">
                    <a href="{{ route('promotions.show', $promotion->id) }}">{{ $promotion->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucune promotion trouvée.</p>
    @endif

    <a href="{{ route('promotions.create') }}" class="btn btn-primary mt-3">Ajouter une Promotion</a>
@endsection

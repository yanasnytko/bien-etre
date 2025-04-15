@extends('layouts.app')

@section('content')
    <h2>Liste des Stages</h2>

    @if($stages->isNotEmpty())
        <ul class="list-group">
            @foreach($stages as $stage)
                <li class="list-group-item">
                    <a href="{{ route('stages.show', $stage->id) }}">{{ $stage->name }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucun stage trouvé.</p>
    @endif

    <a href="{{ route('stages.create') }}" class="btn btn-primary mt-3">Ajouter un Stage</a>
@endsection

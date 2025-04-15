@extends('layouts.app')

@section('content')
    <h2>Liste des Commentaires</h2>

    @if($comments->isNotEmpty())
        <ul class="list-group">
            @foreach($comments as $comment)
                <li class="list-group-item">
                    <a href="{{ route('comments.show', $comment->id) }}">{{ $comment->title }}</a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Aucun commentaire trouvé.</p>
    @endif

    <a href="{{ route('comments.create') }}" class="btn btn-primary mt-3">Ajouter un Commentaire</a>
@endsection

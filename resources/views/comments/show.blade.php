@extends('layouts.app')

@section('content')
    <h2>Détails du Commentaire</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $comment->title }}</h3>
            <p>{{ $comment->content }}</p>
            <p><strong>Note :</strong> {{ $comment->rating }}</p>
            <p><strong>Date :</strong> {{ $comment->date }}</p>
        </div>
    </div>

    <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning">Modifier</a>
    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Confirmer la suppression ?');">Supprimer</button>
    </form>
    <a href="{{ route('comments.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection

@extends('layouts.app')

@section('content')
    <h2>Ajouter un Commentaire</h2>

    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu</label>
            <textarea name="content" id="content" class="form-control" required></textarea>
        </div>
        <!-- N'oublie pas de prévoir les champs pour user_id, service_provider_id, date, rating, etc. -->
        <button type="submit" class="btn btn-success">Publier</button>
    </form>
@endsection

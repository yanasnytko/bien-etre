@extends('layouts.app')

@section('content')
    <h2>Modifier la Promotion</h2>

    <form action="{{ route('promotions.update', $promotion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $promotion->title }}" required>
        </div>
        <!-- Autres champs de modification -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection

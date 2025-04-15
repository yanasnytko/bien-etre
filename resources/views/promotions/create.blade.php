@extends('layouts.app')

@section('content')
    <h2>Créer une Promotion</h2>

    <form action="{{ route('promotions.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <!-- Ajoute d'autres champs comme date_start, date_end, pdf, etc. -->
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
@endsection

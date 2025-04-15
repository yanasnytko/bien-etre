@extends('layouts.app')

@section('content')
    <h2>Créer un nouveau Stage</h2>

    <form action="{{ route('stages.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom du stage</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <!-- Ajoute d'autres champs, par exemple date_start, date_end, cost, etc. -->
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
@endsection

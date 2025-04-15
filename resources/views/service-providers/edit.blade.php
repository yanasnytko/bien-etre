@extends('layouts.app')

@section('content')
    <h2>Modifier le Prestataire</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('service-providers.update', $serviceProvider->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="company_name" class="form-label">Nom de la société</label>
            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $serviceProvider->company_name }}" required>
        </div>
        <div class="mb-3">
            <label for="company_email" class="form-label">Email de la société</label>
            <input type="email" name="company_email" id="company_email" class="form-control" value="{{ $serviceProvider->company_email }}" required>
        </div>
        <!-- Ajoute d'autres champs pour éditer -->
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection

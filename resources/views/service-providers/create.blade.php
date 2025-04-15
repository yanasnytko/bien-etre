@extends('layouts.app')

@section('content')
    <h2>Créer un nouveau Prestataire</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Adapté aux champs dont tu as besoin -->
    <form action="{{ route('service-providers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="company_name" class="form-label">Nom de la société</label>
            <input type="text" name="company_name" id="company_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="company_email" class="form-label">Email de la société</label>
            <input type="email" name="company_email" id="company_email" class="form-control" required>
        </div>
        <!-- Ajoute d'autres champs nécessaires, ex. website, telephone, etc. -->
        <button type="submit" class="btn btn-success">Créer</button>
    </form>
@endsection

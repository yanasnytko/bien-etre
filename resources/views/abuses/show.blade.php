@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('abuses.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">Détails du Signalement d'Abus</h1>
    <p class="mb-2"><strong>ID :</strong> {{ $abuse->id }}</p>
    <p class="mb-2"><strong>Commentaire :</strong> {{ $abuse->comment->title ?? 'N/A' }}</p>
    <p class="mb-2"><strong>Signalé par :</strong> {{ $abuse->reportedBy->name ?? 'Inconnu' }}</p>
    <p class="mb-2"><strong>Raison :</strong> {{ $abuse->reason }}</p>
    <p class="mb-2"><strong>Statut :</strong> {{ ucfirst($abuse->status) }}</p>
    <p class="mb-2"><strong>Date :</strong> {{ $abuse->created_at->format('d/m/Y H:i') }}</p>

    <!-- Formulaire pour modifier le statut de l'abus -->
    <form action="{{ route('abuses.update', $abuse->id) }}" method="POST" class="mt-6">
      @csrf
      @method('PATCH')
      <label for="status" class="block font-semibold mb-2">Changer le statut :</label>
      <select name="status" id="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        <option value="pending" {{ $abuse->status === 'pending' ? 'selected' : '' }}>En attente</option>
        <option value="approved" {{ $abuse->status === 'approved' ? 'selected' : '' }}>Approuvée</option>
        <option value="rejected" {{ $abuse->status === 'rejected' ? 'selected' : '' }}>Rejetée</option>
      </select>
      <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Mettre à jour
      </button>
    </form>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('categorie-proposals.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $categorieProposal->proposed_name }}</h1>
    
    <!-- Badge de statut -->
    <div class="mb-4">
      @if($categorieProposal->status === 'pending')
        <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-200 text-yellow-800 rounded">En attente</span>
      @elseif($categorieProposal->status === 'approved')
        <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-200 text-green-800 rounded">Approuvée</span>
      @elseif($categorieProposal->status === 'rejected')
        <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-200 text-red-800 rounded">Rejetée</span>
      @endif
    </div>
    
    <!-- Description complète -->
    @if($categorieProposal->description)
      <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
        <p class="text-gray-600">{{ $categorieProposal->description }}</p>
      </div>
    @endif

    <!-- Informations complémentaires (par exemple, l'auteur ou la date de proposition) -->
    <div class="mt-4">
      <p class="text-gray-600 text-sm">
        <strong>Proposé par :</strong> {{ $categorieProposal->user->name ?? 'Inconnu' }}
      </p>
      <p class="text-gray-600 text-sm">
        <strong>Date de proposition :</strong> {{ $categorieProposal->created_at->format('d/m/Y') }}
      </p>
    </div>
  </div>
</div>
@endsection

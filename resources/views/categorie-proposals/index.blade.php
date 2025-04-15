@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Titre et bouton d'ajout -->
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Propositions de Catégories</h1>
    <a href="{{ route('categorie-proposals.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
      Nouvelle Proposition
    </a>
  </div>
  
  <!-- Grille responsive de cartes -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($categorieProposals as $proposal)
      <div class="bg-white rounded-lg shadow p-4 flex flex-col">
        <!-- Titre de la proposition -->
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $proposal->proposed_name }}</h3>
        
        <!-- Description tronquée -->
        <p class="text-gray-600 text-sm mb-2">
          {{ \Illuminate\Support\Str::limit($proposal->description, 80) }}
        </p>
        
        <!-- Badge de statut -->
        <div class="mb-4">
          @if($proposal->status === 'pending')
            <span class="inline-block px-2 py-1 text-xs font-semibold bg-yellow-200 text-yellow-800 rounded">En attente</span>
          @elseif($proposal->status === 'approved')
            <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-200 text-green-800 rounded">Approuvée</span>
          @elseif($proposal->status === 'rejected')
            <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-200 text-red-800 rounded">Rejetée</span>
          @endif
        </div>
        
        <!-- Actions (Voir, Modifier, Supprimer) -->
        <div class="mt-auto flex space-x-2">
          <a href="{{ route('categorie-proposals.show', $proposal->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Voir</a>
          <a href="{{ route('categorie-proposals.edit', $proposal->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Modifier</a>
          <form action="{{ route('categorie-proposals.destroy', $proposal->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
              Supprimer
            </button>
          </form>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Liens de pagination -->
  <div class="mt-8">
    {{ $categorieProposals->links() }}
  </div>
</div>
@endsection

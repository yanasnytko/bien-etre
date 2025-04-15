@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('categorie-proposals.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>
  
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Modifier la proposition</h1>
    
    <!-- Affichage des erreurs -->
    @if($errors->any())
      <div class="mb-4">
        <ul class="list-disc list-inside text-red-600">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('categorie-proposals.update', $categorieProposal->id) }}" method="POST">
      @csrf
      @method('PATCH')

      <div class="mb-4">
        <label for="proposed_name" class="block font-semibold mb-1">Nom proposé</label>
        <input type="text" name="proposed_name" id="proposed_name" value="{{ old('proposed_name', $categorieProposal->proposed_name) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="description" class="block font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description', $categorieProposal->description) }}</textarea>
      </div>
      
      <div class="mb-4">
        <label for="status" class="block font-semibold mb-1">Statut</label>
        <select name="status" id="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          <option value="pending" {{ (old('status', $categorieProposal->status) === 'pending') ? 'selected' : '' }}>En attente</option>
          <option value="approved" {{ (old('status', $categorieProposal->status) === 'approved') ? 'selected' : '' }}>Approuvée</option>
          <option value="rejected" {{ (old('status', $categorieProposal->status) === 'rejected') ? 'selected' : '' }}>Rejetée</option>
        </select>
      </div>

      <div>
        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Enregistrer les modifications
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

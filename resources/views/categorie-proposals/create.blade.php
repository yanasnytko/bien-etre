@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('categorie-proposals.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>
  
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Proposer une nouvelle catégorie</h1>
    
    <!-- Affichage des erreurs de validation -->
    @if($errors->any())
      <div class="mb-4">
        <ul class="list-disc list-inside text-red-600">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <form action="{{ route('categorie-proposals.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="proposed_name" class="block font-semibold mb-1">Nom proposé</label>
        <input type="text" name="proposed_name" id="proposed_name" value="{{ old('proposed_name') }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      
      <div class="mb-4">
        <label for="description" class="block font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description') }}</textarea>
      </div>
      
      <!-- Optionnel : si vous souhaitez permettre à l'utilisateur de sélectionner un statut (par exemple, pour test en admin) -->
      <div class="mb-4">
        <label for="status" class="block font-semibold mb-1">Statut</label>
        <select name="status" id="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>En attente</option>
          <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>Approuvée</option>
          <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }}>Rejetée</option>
        </select>
      </div>
      
      <div>
        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Envoyer la proposition
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

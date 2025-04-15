@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('comments.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>
  
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Ajouter un Commentaire</h1>
    
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

    <form action="{{ route('comments.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="title" class="block font-semibold mb-1">Titre</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="content" class="block font-semibold mb-1">Contenu</label>
        <textarea name="content" id="content" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('content') }}</textarea>
      </div>

      <div class="mb-4">
        <label for="rating" class="block font-semibold mb-1">Note (optionnelle)</label>
        <input type="number" name="rating" id="rating" min="0" max="5" value="{{ old('rating') }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <!-- Vous pouvez ajouter des champs cachés pour user_id et service_provider_id,
           ou les remplir automatiquement dans le contrôleur selon le contexte -->

      <div>
        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Envoyer le Commentaire
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

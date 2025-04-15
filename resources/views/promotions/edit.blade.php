@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('promotions.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>
  
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Modifier la Promotion</h1>
    
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
    
    <form action="{{ route('promotions.update', $promotion->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mb-4">
        <label for="title" class="block font-semibold mb-1">Titre</label>
        <input type="text" name="title" id="title" value="{{ old('title', $promotion->title) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <!-- Champ pour PDF (optionnel) -->
      <div class="mb-4">
        <label for="pdf" class="block font-semibold mb-1">PDF (optionnel)</label>
        <input type="file" name="pdf" id="pdf"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @if($promotion->pdf)
          <p class="text-sm text-gray-600 mt-2">PDF actuellement chargé.</p>
        @endif
      </div>

      <div class="mb-4">
        <label for="date_start" class="block font-semibold mb-1">Date de début de promotion</label>
        <input type="date" name="date_start" id="date_start" value="{{ old('date_start', $promotion->date_start->format('Y-m-d')) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="date_end" class="block font-semibold mb-1">Date de fin de promotion</label>
        <input type="date" name="date_end" id="date_end" value="{{ old('date_end', $promotion->date_end->format('Y-m-d')) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="display_start" class="block font-semibold mb-1">Date de début d'affichage</label>
        <input type="date" name="display_start" id="display_start" value="{{ old('display_start', $promotion->display_start->format('Y-m-d')) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="display_end" class="block font-semibold mb-1">Date de fin d'affichage</label>
        <input type="date" name="display_end" id="display_end" value="{{ old('display_end', $promotion->display_end->format('Y-m-d')) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="description" class="block font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description', $promotion->description) }}</textarea>
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

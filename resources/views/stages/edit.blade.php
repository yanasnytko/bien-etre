@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('stages.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Modifier le Stage</h1>

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

    <form action="{{ route('stages.update', $stage->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mb-4">
        <label for="name" class="block font-semibold mb-1">Nom du Stage</label>
        <input type="text" name="name" id="name" value="{{ old('name', $stage->name) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      
      <div class="mb-4">
        <label for="image" class="block font-semibold mb-1">Image (optionnel)</label>
        <input type="file" name="image" id="image"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @if($stage->image)
          <p class="text-sm text-gray-600 mt-2">Image actuellement chargée.</p>
        @endif
      </div>
      
      <div class="mb-4">
        <label for="date_start" class="block font-semibold mb-1">Date de Début</label>
        <input type="date" name="date_start" id="date_start" value="{{ old('date_start', $stage->date_start->format('Y-m-d')) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      
      <div class="mb-4">
        <label for="date_end" class="block font-semibold mb-1">Date de Fin</label>
        <input type="date" name="date_end" id="date_end" value="{{ old('date_end', $stage->date_end->format('Y-m-d')) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="cost" class="block font-semibold mb-1">Coût</label>
        <input type="number" name="cost" id="cost" step="0.01" value="{{ old('cost', $stage->cost) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="currency" class="block font-semibold mb-1">Devise</label>
        <input type="text" name="currency" id="currency" value="{{ old('currency', $stage->currency) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="description" class="block font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description', $stage->description) }}</textarea>
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

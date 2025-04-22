{{-- resources/views/stages/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('stages.index') }}"
     class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Créer un Stage</h1>

    {{-- Erreurs --}}
    @if($errors->any())
      <div class="mb-4">
        <ul class="list-disc list-inside text-red-600">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('stages.store') }}"
          method="POST"
          enctype="multipart/form-data">
      @csrf

      {{-- On lie le future stage au prestataire authentifié --}}
      <input type="hidden" name="service_provider_id" value="{{ $serviceProviderId }}">

      {{-- Nom --}}
      <div class="mb-4">
        <label for="name" class="block font-semibold mb-1">Nom du Stage</label>
        <input type="text" name="name" id="name"
               value="{{ old('name') }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      {{-- Description --}}
      <div class="mb-4">
        <label for="description" class="block font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description') }}</textarea>
      </div>

      {{-- Image --}}
      <div class="mb-4">
        <label for="image" class="block font-semibold mb-1">Image (optionnel)</label>
        <input type="file" name="image" id="image"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      {{-- Période du stage --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label for="date_start" class="block font-semibold mb-1">Date de Début</label>
          <input type="date" name="date_start" id="date_start"
                 value="{{ old('date_start') }}"
                 class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        </div>
        <div>
          <label for="date_end" class="block font-semibold mb-1">Date de Fin</label>
          <input type="date" name="date_end" id="date_end"
                 value="{{ old('date_end') }}"
                 class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        </div>
      </div>

      {{-- Période d'affichage --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label for="display_start" class="block font-semibold mb-1">Date de Début d'Affichage</label>
          <input type="date" name="display_start" id="display_start"
                 value="{{ old('display_start') }}"
                 class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        </div>
        <div>
          <label for="display_end" class="block font-semibold mb-1">Date de Fin d'Affichage</label>
          <input type="date" name="display_end" id="display_end"
                 value="{{ old('display_end') }}"
                 class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        </div>
      </div>

      {{-- Coût et devise --}}
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
          <label for="cost" class="block font-semibold mb-1">Coût</label>
          <input type="number" name="cost" id="cost"
                 step="0.01" value="{{ old('cost') }}"
                 class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        </div>
        <div>
          <label for="currency" class="block font-semibold mb-1">Devise</label>
          <input type="text" name="currency" id="currency"
                 value="{{ old('currency', 'EUR') }}"
                 class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        </div>
      </div>

      {{-- Est actif ? --}}
      <div class="mb-6 flex items-center">
        <input type="checkbox" name="is_active" id="is_active"
               value="1" 
               {{ old('is_active', true) ? 'checked' : '' }}
               class="h-4 w-4 text-blue-600 border-gray-300 rounded">
        <label for="is_active" class="ml-2 text-gray-700">
          Activer l’affichage immédiatement
        </label>
      </div>

      {{-- Bouton --}}
      <div>
        <button type="submit"
                class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Créer le Stage
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

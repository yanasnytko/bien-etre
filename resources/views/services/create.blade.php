@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('services.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>
  
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Ajouter un Service</h1>
    
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

    <form action="{{ route('services.store') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="name" class="block font-semibold mb-1">Nom du Service</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="description" class="block font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description') }}</textarea>
      </div>

      <div class="mb-4">
        <label for="featured" class="block font-semibold mb-1">Mettre en avant ce service ?</label>
        <select name="featured" id="featured" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          <option value="0" {{ old('featured', '0') == '0' ? 'selected' : '' }}>Non</option>
          <option value="1" {{ old('featured') == '1' ? 'selected' : '' }}>Oui</option>
        </select>
      </div>

      <div>
        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Créer le Service
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

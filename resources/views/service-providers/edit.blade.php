@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('service-providers.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>
  
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Modifier le Prestataire</h1>
    
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

    <form action="{{ route('service-providers.update', $serviceProvider->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mb-4">
        <label for="company_name" class="block font-semibold mb-1">Nom de l'entreprise</label>
        <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $serviceProvider->company_name) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="company_email" class="block font-semibold mb-1">Email de l'entreprise</label>
        <input type="email" name="company_email" id="company_email" value="{{ old('company_email', $serviceProvider->company_email) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="website" class="block font-semibold mb-1">Site Web</label>
        <input type="url" name="website" id="website" value="{{ old('website', $serviceProvider->website) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="telephone" class="block font-semibold mb-1">Téléphone</label>
        <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $serviceProvider->telephone) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="vat_number" class="block font-semibold mb-1">Numéro de TVA</label>
        <input type="text" name="vat_number" id="vat_number" value="{{ old('vat_number', $serviceProvider->vat_number) }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="logo" class="block font-semibold mb-1">Logo (optionnel)</label>
        <input type="file" name="logo" id="logo"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div class="mb-4">
        <label for="description" class="block font-semibold mb-1">Description</label>
        <textarea name="description" id="description" rows="4"
                  class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description', $serviceProvider->description) }}</textarea>
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

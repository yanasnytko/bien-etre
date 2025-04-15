@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Confirmer la Suppression</h1>
    <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer ce prestataire ? Cette action est irréversible.</p>
    
    <form action="{{ route('service-providers.destroy', $serviceProvider->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <div class="flex justify-between">
        <a href="{{ route('service-providers.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
          Annuler
        </a>
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
          Supprimer
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Nos Prestataires</h1>
    <a href="{{ route('service-providers.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
      Ajouter un Prestataire
    </a>
  </div>
  
  <!-- Grille responsive de cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($serviceProviders as $provider)
      <div class="bg-white rounded-lg shadow p-4 flex flex-col">
        <div class="mb-2">
          @if($provider->logo)
            <img src="{{ $provider->logo }}" alt="{{ $provider->company_name }}" class="w-full h-32 object-cover rounded">
          @else
            <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center">
              <span class="text-gray-500">Pas d'image</span>
            </div>
          @endif
        </div>
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $provider->company_name }}</h3>
        @if($provider->services && $provider->services->isNotEmpty())
          <div class="mb-2">
            <p class="text-sm font-semibold text-gray-600">Catégories :</p>
            <ul class="mt-1 list-disc list-inside text-sm text-gray-500">
              @foreach($provider->services as $service)
                <li>{{ $service->name }}</li>
              @endforeach
            </ul>
          </div>
        @else
          <p class="text-sm text-gray-500">Aucune catégorie assignée.</p>
        @endif
        <div class="mt-auto flex space-x-2">
          <a href="{{ route('service-providers.show', $provider->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir
          </a>
          <!--<a href="{{ route('service-providers.edit', $provider->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
            Modifier
          </a> -->
          <!-- Bouton de suppression via un formulaire (ajouter confirmation côté JS ou Livewire) -->
          <!--<form method="POST" action="{{ route('service-providers.destroy', $provider->id) }}" onsubmit="return confirm('Confirmez-vous la suppression ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
              Supprimer
            </button>
          </form> -->
        </div>
      </div>
    @endforeach
  </div>
  
  <!-- Liens de pagination -->
  <div class="mt-8">
    {{ $serviceProviders->links() }}
  </div>
</div>
@endsection

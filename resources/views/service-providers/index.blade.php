{{-- resources/views/service-providers/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  {{-- En‑tête et bouton d’ajout --}}
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Nos Prestataires</h1>
  </div>

  {{-- Grille responsive --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($serviceProviders as $provider)
      <div
        class="relative bg-white rounded-lg shadow p-4 flex flex-col"
        @auth
          x-data="{ 
            favorited: {{ Auth::user()
              ->favorites()
              ->where('favoriteable_id', $provider->id)
              ->where('favoriteable_type', 'service_providers')
              ->exists() ? 'true' : 'false' }} 
          }"
        @endauth
      >
        {{-- Bouton “favoris” --}}
        @auth
        <button @click="
            fetch('{{ route('favorites.toggle') }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                favoriteable_id: {{ $provider->id }},
                favoriteable_type: 'service_providers'
              })
            })
            .then(r => r.json())
            .then(data => favorited = (data.action === 'added'))
          "
          class="absolute top-2 right-2 focus:outline-none"
          title="Ajouter/Retirer des favoris"
        >
          <template x-if="!favorited">
            {{-- Cœur vide --}}
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6 text-gray-400 hover:text-red-500 transition"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 
                       4.5 0 016.364 6.364L12 21.364l-7.682-7.682a4.5 
                       4.5 0 010-6.364z"/>
            </svg>
          </template>
          <template x-if="favorited">
            {{-- Cœur plein --}}
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6 text-red-500"
                 fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 
                       4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 
                       14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 
                       6.86-8.55 11.54L12 21.35z"/>
            </svg>
          </template>
        </button>
        @endauth

        {{-- Logo / Image --}}
        <div class="mb-2">
          @if($provider->logo)
            <img src="{{ $provider->logo }}"
                 alt="{{ $provider->company_name }}"
                 class="w-full h-32 object-cover rounded mb-2">
          @else
            <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center mb-2">
              <span class="text-gray-500">Pas d'image</span>
            </div>
          @endif
        </div>

        {{-- Nom --}}
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $provider->company_name }}</h3>

        {{-- Catégories --}}
        @if($provider->services->isNotEmpty())
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
        
        {{-- Localité (protégée avec optional()) --}}
        <p class="text-sm text-gray-600 mt-4">
          <strong>Localité :</strong>
          {{ optional(
              optional(
                optional($provider->user)->address
              )->localite
            )->city
            ?? 'Non renseignée'
          }}
        </p>

        {{-- Bouton “Voir” --}}
        <div class="mt-auto">
          <a href="{{ route('service-providers.show', $provider) }}"
             class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir
          </a>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Pagination --}}
  <div class="mt-8">
    {{ $serviceProviders->links() }}
  </div>
</div>
@endsection

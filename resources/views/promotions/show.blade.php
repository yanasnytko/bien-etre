{{-- resources/views/promotions/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Lien retour -->
  <a href="{{ route('promotions.index') }}"
     class="text-blue-600 hover:underline mb-4 inline-block">
    &larr; Retour aux promotions
  </a>

  <div class="bg-white rounded-lg shadow p-6 relative">
    <!-- BOUTON FAVORI -->
    @auth
      <div x-data="{
            favorited: {{ Auth::user()
              ->favorites()
              ->where('favoriteable_id', $promotion->id)
              ->where('favoriteable_type', \App\Models\Promotion::class)
              ->exists() ? 'true' : 'false' }}
          }"
           class="absolute top-4 right-4"
      >
        <button @click="
            fetch('{{ route('favorites.toggle') }}', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({
                favoriteable_id: {{ $promotion->id }},
                favoriteable_type: @json(\App\Models\Promotion::class)
              })
            })
            .then(r => r.json())
            .then(data => favorited = data.action === 'added')
          "
          class="focus:outline-none"
          aria-label="Ajouter/Retirer des favoris">
          <template x-if="! favorited">
            {{-- Cœur vide --}}
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6 text-gray-400 hover:text-red-500 transition" 
                 fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 016.364 0L12 
                       7.636l1.318-1.318a4.5 4.5 0 
                       016.364 6.364L12 21.364l-7.682-7.682a4.5 
                       4.5 0 010-6.364z"/>
            </svg>
          </template>
          <template x-if="favorited">
            {{-- Cœur plein --}}
            <svg xmlns="http://www.w3.org/2000/svg" 
                 class="h-6 w-6 text-red-500" fill="currentColor" 
                 viewBox="0 0 24 24">
              <path d="M12 21.35l-1.45-1.32C5.4 
                       15.36 2 12.28 2 8.5 2 5.42 
                       4.42 3 7.5 3c1.74 0 3.41.81 
                       4.5 2.09C13.09 3.81 14.76 
                       3 16.5 3 19.58 3 22 5.42 
                       22 8.5c0 3.78-3.4 
                       6.86-8.55 11.54L12 21.35z"/>
            </svg>
          </template>
        </button>
      </div>
    @endauth

    <!-- Titre -->
    <h1 class="text-3xl font-bold text-gray-800 mb-4">
      {{ $promotion->title }}
    </h1>

    <!-- PDF -->
    @if($promotion->pdf)
      <div class="mb-4">
        <a href="{{ asset('storage/' . $promotion->pdf) }}" 
           target="_blank" 
           class="text-blue-600 underline">
          Télécharger le PDF de la promotion
        </a>
      </div>
    @endif

    <!-- Prestataire -->
    @if($promotion->serviceProvider)
      <p class="text-gray-600 mb-4">
        <strong>Prestataire :</strong>
        <a href="{{ route('service-providers.show', $promotion->serviceProvider) }}"
           class="text-blue-600 hover:underline">
          {{ $promotion->serviceProvider->company_name }}
        </a>
      </p>
    @endif

    <!-- Périodes -->
    <div class="mb-4 space-y-2">
      <p class="text-gray-600">
        <strong>Période de promotion :</strong>
        Du {{ $promotion->date_start->format('d/m/Y') }}
        au {{ $promotion->date_end->format('d/m/Y') }}
      </p>
      <p class="text-gray-600">
        <strong>Période d'affichage :</strong>
        Du {{ $promotion->display_start->format('d/m/Y') }}
        au {{ $promotion->display_end->format('d/m/Y') }}
      </p>
    </div>

    <!-- Description -->
    @if($promotion->description)
      <div class="mt-4">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
        <p class="text-gray-600">{{ $promotion->description }}</p>
      </div>
    @endif

    <!-- ACTIONS PROPRIÉTAIRE -->
    @auth
      @php
        // ID du service provider de l'utilisateur connecté
        $myProviderId = optional(Auth::user()->serviceProvider)->id;
      @endphp

      @if($promotion->service_provider_id === $myProviderId)
        <div class="mt-6 flex space-x-2">
          <!-- Modifier -->
          <a href="{{ route('promotions.edit', $promotion) }}"
             class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
            Modifier
          </a>
          <!-- Supprimer -->
          <form action="{{ route('promotions.destroy', $promotion) }}" method="POST"
                onsubmit="return confirm('Confirmez-vous la suppression de cette promotion ?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
              Supprimer
            </button>
          </form>
        </div>
      @endif
    @endauth
  </div>
</div>
@endsection

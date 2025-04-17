{{-- resources/views/stages/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  {{-- Bouton retour --}}
  <a href="{{ route('stages.index') }}"
     class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6 space-y-6">
    <div class="flex flex-col md:flex-row md:space-x-6">
      {{-- SECTION IMAGE --}}
      <div class="md:w-1/3">
        @if($stage->image)
          <img src="{{ $stage->image }}"
               alt="{{ $stage->name }}"
               class="w-full h-auto rounded">
        @else
          <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
            <span class="text-gray-500">Pas d'image</span>
          </div>
        @endif
      </div>

      {{-- SECTION DÉTAILS DU STAGE + BOUTON FAVORIS --}}
      <div class="md:w-2/3 relative">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $stage->name }}</h1>

        <p class="text-gray-600 mb-1">
          <strong>Date :</strong>
          du {{ \Carbon\Carbon::parse($stage->date_start)->format('d/m/Y') }}
          au {{ \Carbon\Carbon::parse($stage->date_end)->format('d/m/Y') }}
        </p>
        <p class="text-gray-600 mb-3">
          <strong>Coût :</strong> {{ $stage->cost }} {{ $stage->currency }}
        </p>

        {{-- Bouton Favoris (visible seulement si connecté) --}}
        @auth
          <div class="absolute top-0 right-0 mt-1 mr-1"
               x-data="{ favorited: {{ Auth::user()->favorites()
                                  ->where('favoriteable_id', $stage->id)
                                  ->where('favoriteable_type', 'stages')
                                  ->exists()
                                  ? 'true' : 'false' }} }">
            <button @click="
              fetch('{{ route('favorites.toggle') }}', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                  favoriteable_id: {{ $stage->id }},
                  favoriteable_type: 'stages'
                })
              })
              .then(r => r.json())
              .then(data => favorited = (data.action === 'added'))
            " class="focus:outline-none"  
              :title="favorited ? 'Retirer des favoris' : 'Ajouter aux favoris'">
              
              <template x-if="!favorited">
                {{-- Coeur vide --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-gray-400 hover:text-red-500 transition"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 
                          4.5 0 016.364 6.364L12 21.364l-7.682-7.682a4.5 
                          4.5 0 010-6.364z" />
                </svg>
              </template>

              <template x-if="favorited">
                {{-- Coeur plein --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6 text-red-500"
                     fill="currentColor" viewBox="0 0 24 24">
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
      </div>
    </div>

    {{-- DESCRIPTION --}}
    @if($stage->description)
      <div class="prose max-w-none">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
        <p class="text-gray-600">{{ $stage->description }}</p>
      </div>
    @endif

    {{-- PRESTATAIRE --}}
    <div>
      <h2 class="text-xl font-semibold text-gray-700 mb-2">Prestataire</h2>
      @if($stage->serviceProvider)
        <div class="flex items-center space-x-4">
          @if($stage->serviceProvider->logo)
            <img src="{{ $stage->serviceProvider->logo }}"
                 alt="{{ $stage->serviceProvider->company_name }}"
                 class="w-16 h-16 object-cover rounded">
          @endif
          <div>
            <a href="{{ route('service-providers.show', $stage->serviceProvider) }}"
               class="text-blue-600 hover:underline text-lg font-medium">
              {{ $stage->serviceProvider->company_name }}
            </a>
            <p class="text-gray-600 text-sm">
              {{ $stage->serviceProvider->company_email }}
              – {{ $stage->serviceProvider->telephone }}
            </p>
          </div>
        </div>
      @else
        <p class="text-gray-500">Prestataire non renseigné.</p>
      @endif
    </div>

    @auth
      @php
        $user    = Auth::user();
        $ownerSP = optional($user->serviceProvider)->id;
      @endphp

      @if($stage->service_provider_id === $ownerSP)
        <div class="flex space-x-2">
          {{-- Modifier --}}
          <a href="{{ route('stages.edit', $stage) }}"
             class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
            Modifier
          </a>

          {{-- Supprimer --}}
          <form action="{{ route('stages.destroy', $stage) }}" method="POST"
                onsubmit="return confirm('Voulez-vous vraiment supprimer ce stage ?')">
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

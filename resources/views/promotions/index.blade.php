{{-- resources/views/promotions/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  {{-- En‑tête et bouton d’ajout --}}
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Nos Promotions</h1>
    @auth
      @if(Auth::user()->is_provider)
        <a href="{{ route('promotions.create') }}"
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
          Ajouter une Promotion
        </a>
      @endif
    @endauth
  </div>

  {{-- Grille responsive --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($promotions as $promotion)
      <div
        class="relative bg-white rounded-lg shadow p-4"
        @auth
        x-data="{ 
          favorited: {{ Auth::user()
            ->favorites()
            ->where('favoriteable_id', $promotion->id)
            ->where('favoriteable_type', 'promotions')
            ->exists() ? 'true' : 'false' }} 
        }"
        @endauth
      >
        {{-- Titre --}}
        <h3 class="text-xl font-semibold mb-2">{{ $promotion->title }}</h3>

        {{-- Description tronquée --}}
        <p class="text-gray-600 mb-3">
          {{ \Illuminate\Support\Str::limit($promotion->description, 100) }}
        </p>

        {{-- Période --}}
        <p class="text-gray-600 text-sm mb-3">
          <strong>Du :</strong> {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }}<br>
          <strong>Au :</strong> {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
        </p>

        {{-- Lien “Voir” --}}
        <a href="{{ route('promotions.show', $promotion) }}"
          class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Voir
        </a>

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
                favoriteable_id: {{ $promotion->id }},
                favoriteable_type: 'promotions'
              })
            })
            .then(r => r.json())
            .then(data => favorited = (data.action === 'added'))
          "
          class="absolute top-2 right-2 focus:outline-none"
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
      </div>
    @endforeach
  </div>

  {{-- Pagination --}}
  <div class="mt-8">
    {{ $promotions->links() }}
  </div>
</div>
@endsection

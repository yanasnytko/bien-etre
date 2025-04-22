@extends('layouts.app')

{{-- Section hero affichée uniquement sur la page d'accueil --}}
@section('hero')
<section class="bg-blue-50 py-12">
  <div class="container mx-auto text-center px-4">
    <h1 class="text-4xl font-bold text-blue-700 mb-4">Bienvenue sur l'Annuaire Bien-Être</h1>
    <p class="text-xl text-blue-600 mb-8">Découvrez les meilleurs prestataires de bien-être près de chez vous.</p>
    <form action="{{ route('service-providers.search') }}" method="GET"
          class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-4">
      <!-- Catégorie de service -->
      <select name="service_id"
              class="border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        <option value="">-- Catégorie de service --</option>
        @foreach($services as $service)
          <option value="{{ $service->id }}"
                  {{ request('service_id') == $service->id ? 'selected' : '' }}>
            {{ $service->name }}
          </option>
        @endforeach
      </select>

      <!-- Localité -->
      <input type="text" name="localite" placeholder="Localité (ex. Bruxelles)"
             value="{{ request('localite') }}"
             class="border rounded px-3 py-2 focus:outline-none focus:border-blue-600">

      <!-- Recherche par nom -->
      <input type="text" name="name" placeholder="Nom du prestataire"
             value="{{ request('name') }}"
             class="border rounded px-3 py-2 focus:outline-none focus:border-blue-600">

      <button type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Rechercher
      </button>
    </form>
  </div>
</section>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8 space-y-16">

  {{-- Nos Prestataires --}}
  <section>
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-3xl font-bold text-gray-800">Nos Prestataires</h2>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($serviceProviders as $provider)
      <div class="relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
        {{-- Bouton favoris --}}
        @auth
        <div class="absolute top-2 right-2" x-data="{ 
            favorited: {{ Auth::user()->favorites()
                         ->where('favoriteable_id',$provider->id)
                         ->where('favoriteable_type','service_providers')
                         ->exists() ? 'true':'false' }} 
          }">
          <button @click="
              fetch('{{ route('favorites.toggle') }}', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                body: JSON.stringify({
                  favoriteable_id: {{ $provider->id }},
                  favoriteable_type: 'service_providers'
                })
              }).then(r=>r.json()).then(data=> favorited = (data.action==='added'))
            "
            class="focus:outline-none"
            title="Ajouter/Retirer des favoris">
            <template x-if="!favorited">
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
              <svg xmlns="http://www.w3.org/2000/svg"
                   class="h-6 w-6 text-red-500"
                   fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36
                         2 12.28 2 8.5 2 5.42 4.42 3
                         7.5 3c1.74 0 3.41.81 4.5
                         2.09C13.09 3.81 14.76 3
                         16.5 3 19.58 3 22 5.42
                         22 8.5c0 3.78-3.4
                         6.86-8.55 11.54L12 21.35z"/>
              </svg>
            </template>
          </button>
        </div>
        @endauth

        {{-- Logo / image --}}
        @if($provider->logo)
          <img src="{{ $provider->logo }}"
               alt="{{ $provider->company_name }}"
               class="w-full h-32 object-cover rounded mb-2">
        @else
          <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center mb-2">
            <span class="text-gray-500">Pas d'image</span>
          </div>
        @endif

        {{-- Nom --}}
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $provider->company_name }}</h3>
        <a href="{{ route('service-providers.show', $provider) }}"
           class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Voir plus
        </a>
      </div>
      @endforeach
    </div>
    <div class="mt-8 text-center">
      <a href="{{ route('service-providers.index') }}"
         class="text-blue-600 hover:underline">Voir tous les prestataires</a>
    </div>
  </section>

  {{-- Nos Stages --}}
  <section>
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Nos Stages</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($stages as $stage)
        <div class="relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
          {{-- Bouton favoris (visible aux utilisateurs connectés) --}}
          @auth
          <div class="absolute top-2 right-2" x-data="{ 
              favorited: {{ Auth::user()->favorites()
                          ->where('favoriteable_id',$stage->id)
                          ->where('favoriteable_type','stages')
                          ->exists() ? 'true':'false' }} 
            }">
            <button @click="
                fetch('{{ route('favorites.toggle') }}', {
                  method: 'POST',
                  headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                  },
                  body: JSON.stringify({
                    favoriteable_id: {{ $stage->id }},
                    favoriteable_type: 'stages'
                  })
                })
                .then(r => r.json())
                .then(data => favorited = (data.action === 'added'))
              "
              class="focus:outline-none"
              title="Ajouter/Retirer des favoris">
              <template x-if="!favorited">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-gray-400 hover:text-red-500 transition"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318
                          a4.5 4.5 0 016.364 6.364L12 21.364l-7.682-7.682
                          a4.5 4.5 0 010-6.364z"/>
                </svg>
              </template>
              <template x-if="favorited">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-red-500"
                    fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                          2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                          C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42
                          22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
              </template>
            </button>
          </div>
          @endauth

          {{-- Si vous aviez une image --}}
          @if($stage->image)
            <img src="{{ $stage->image }}"
                alt="{{ $stage->name }}"
                class="w-full h-32 object-cover rounded mb-2">
          @else
            <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center mb-2">
              <span class="text-gray-500">Pas d'image</span>
            </div>
          @endif

          {{-- Titre --}}
          <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $stage->name }}</h3>
          {{-- Dates --}}
          <p class="text-gray-600 text-sm mb-4">
            Du {{ \Carbon\Carbon::parse($stage->date_start)->format('d/m/Y') }}
            au {{ \Carbon\Carbon::parse($stage->date_end)->format('d/m/Y') }}
          </p>
          {{-- Bouton Voir --}}
          <a href="{{ route('stages.show', $stage) }}"
            class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir
          </a>
        </div>
      @endforeach
    </div>
    <div class="mt-8 text-center">
      <a href="{{ route('stages.index') }}" class="text-blue-600 hover:underline">
        Voir tous les stages
      </a>
    </div>
  </section>


  {{-- Promotions Actuelles --}}
  <section>
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Promotions Actuelles</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($promotions as $promotion)
      <div class="relative bg-white rounded-lg shadow hover:shadow-lg transition p-4 flex flex-col">
        @auth
        <div class="absolute top-2 right-2" x-data="{ 
            favorited: {{ Auth::user()->favorites()
                         ->where('favoriteable_id',$promotion->id)
                         ->where('favoriteable_type','promotions')
                         ->exists() ? 'true':'false' }} 
          }">
          <button @click="
              fetch('{{ route('favorites.toggle') }}', {
                method: 'POST',
                headers: {'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                body: JSON.stringify({
                  favoriteable_id: {{ $promotion->id }},
                  favoriteable_type: 'promotions'
                })
              }).then(r=>r.json()).then(data=> favorited = (data.action==='added'))
            "
            class="focus:outline-none"
            title="Ajouter/Retirer des favoris">
            <template x-if="!favorited">
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
              <svg xmlns="http://www.w3.org/2000/svg"
                   class="h-6 w-6 text-red-500"
                   fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36
                         2 12.28 2 8.5 2 5.42 4.42 3
                         7.5 3c1.74 0 3.41.81 4.5
                         2.09C13.09 3.81 14.76 3
                         16.5 3 19.58 3 22 5.42
                         22 8.5c0 3.78-3.4
                         6.86-8.55 11.54L12 21.35z"/>
              </svg>
            </template>
          </button>
        </div>
        @endauth

        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $promotion->title }}</h3>
        <p class="text-gray-600 text-sm mb-4">
          Du {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }}
          au {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
        </p>
        <a href="{{ route('promotions.show', $promotion) }}"
           class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Voir plus
        </a>
      </div>
      @endforeach
    </div>
    <div class="mt-8 text-center">
      <a href="{{ route('promotions.index') }}"
         class="text-blue-600 hover:underline">Voir toutes les promotions</a>
    </div>
  </section>

</div>
@endsection

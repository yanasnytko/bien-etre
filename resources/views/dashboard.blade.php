{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('hero')
<section class="bg-blue-50 py-12">
  <div class="container mx-auto text-center px-4">
    <h1 class="text-4xl font-bold text-blue-700 mb-4">Bienvenue, {{ Auth::user()->name }} !</h1>
    <p class="text-xl text-blue-600 mb-8">Gérez vos informations personnelles et vos paramètres.</p>
  </div>
</section>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row items-center md:items-start">
      @if(\Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="flex-shrink-0">
          <img class="w-32 h-32 rounded-full object-cover"
               src="{{ Auth::user()->profile_photo_url }}"
               alt="{{ Auth::user()->name }}">
        </div>
      @endif

      <div class="mt-4 md:mt-0 md:ml-6 w-full">
        <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
        <p class="text-gray-600 mb-2"><strong>Email :</strong> {{ Auth::user()->email }}</p>
        <p class="text-gray-600 mb-2"><strong>Type :</strong> {{ ucfirst(Auth::user()->user_type) }}</p>
        <div class="mt-4 flex flex-wrap gap-4">
          <a href="{{ route('profile.show') }}"
             class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Modifier le Profil
          </a>
          <a href="{{ route('user.password.edit') }}"
             class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Changer le Mot de Passe
          </a>
        </div>
      </div>
    </div>

    {{-- Favoris --}}
    <div class="bg-white rounded-lg shadow p-6 mt-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Mes Favoris</h2>

      @if($favorites->isEmpty())
        <p class="text-gray-600">Vous n'avez pas encore ajouté de favoris.</p>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($favorites as $fav)
            @php $item = $fav->favoriteable; @endphp
            <div class="relative bg-gray-100 rounded-lg overflow-hidden shadow-sm">
              <div class="p-4">
                @if($item instanceof \App\Models\ServiceProvider)
                  <h3 class="text-xl font-semibold mb-2">{{ $item->company_name }}</h3>
                  <p class="text-gray-600 mb-2">Prestataire</p>
                  <a href="{{ route('service-providers.show', $item) }}"
                     class="text-blue-600 hover:underline text-sm">
                    Voir la fiche
                  </a>

                @elseif($item instanceof \App\Models\Stage)
                  <h3 class="text-xl font-semibold mb-2">{{ $item->name }}</h3>
                  <p class="text-gray-600 mb-2">
                    Stage du {{ \Carbon\Carbon::parse($item->date_start)->format('d/m/Y') }}
                  </p>
                  <a href="{{ route('stages.show', $item) }}"
                     class="text-blue-600 hover:underline text-sm">
                    Voir le stage
                  </a>

                @elseif($item instanceof \App\Models\Promotion)
                  <h3 class="text-xl font-semibold mb-2">{{ $item->title }}</h3>
                  <p class="text-gray-600 mb-2">
                    Promo du {{ \Carbon\Carbon::parse($item->date_start)->format('d/m/Y') }}
                  </p>
                  <a href="{{ route('promotions.show', $item) }}"
                     class="text-blue-600 hover:underline text-sm">
                    Voir la promo
                  </a>

                @else
                  <p class="text-gray-600">Élément favori</p>
                @endif
              </div>

              {{-- Cœur “favori” pour retirer --}}
              <div class="absolute top-2 right-2" x-data="{ removing: false }">
                <button 
                  @click.prevent="
                    removing = true;
                    fetch('{{ route('favorites.toggle') }}', {
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      },
                      body: JSON.stringify({
                        favoriteable_id: {{ $fav->favoriteable_id }},
                        favoriteable_type: '{{ $fav->favoriteable_type }}'
                      })
                    })
                    .then(r => r.json())
                    .then(() => $el.closest('div').remove())
                  "
                  :class="removing ? 'opacity-50 cursor-wait' : ''"
                  class="focus:outline-none"
                  title="Retirer des favoris"
                >
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
                </button>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>

  {{-- Pour les providers : Mes Stages & Mes Promotions --}}
  @if(Auth::user()->is_provider && Auth::user()->serviceProvider)
    {{-- Mes Stages --}}
    <div class="bg-white rounded-lg shadow p-6 mt-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Mes Stages</h2>
      @if($stages->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($stages as $stage)
            <div class="bg-gray-100 rounded p-4">
              <h3 class="text-xl font-bold mb-2">{{ $stage->name }}</h3>
              <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($stage->description, 80) }}</p>
              <p class="text-gray-600 mt-2">
                Du {{ \Carbon\Carbon::parse($stage->date_start)->format('d/m/Y') }}
                au {{ \Carbon\Carbon::parse($stage->date_end)->format('d/m/Y') }}
              </p>
              <div class="mt-4 flex space-x-2">
                <a href="{{ route('stages.edit', $stage) }}"
                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">
                  Modifier
                </a>
                <form action="{{ route('stages.destroy', $stage) }}" method="POST"
                      onsubmit="return confirm('Confirmez-vous la suppression ?')" class="inline-block">
                  @csrf @method('DELETE')
                  <button type="submit"
                          class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">
                    Supprimer
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-gray-600">Vous n'avez pas encore créé de stage.</p>
      @endif
    </div>

    {{-- Mes Promotions --}}
    <div class="bg-white rounded-lg shadow p-6 mt-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Mes Promotions</h2>
      @if($promotions->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($promotions as $promotion)
            <div class="bg-gray-100 rounded p-4">
              <h3 class="text-xl font-bold mb-2">{{ $promotion->title }}</h3>
              <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($promotion->description, 80) }}</p>
              <p class="text-gray-600 mt-2">
                Du {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }}
                au {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
              </p>
              <div class="mt-4 flex space-x-2">
                <a href="{{ route('promotions.edit', $promotion) }}"
                   class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">
                  Modifier
                </a>
                <form action="{{ route('promotions.destroy', $promotion) }}" method="POST"
                      onsubmit="return confirm('Confirmez-vous la suppression ?')" class="inline-block">
                  @csrf @method('DELETE')
                  <button type="submit"
                          class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">
                    Supprimer
                  </button>
                </form>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p class="text-gray-600">Vous n'avez pas encore créé de promotion.</p>
      @endif
    </div>
  @endif
</div>
@endsection

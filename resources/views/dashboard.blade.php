@extends('layouts.app')

@section('hero')
<!-- Section Hero personnalisée pour la page Mon Compte -->
<section class="bg-blue-50 py-12">
  <div class="container mx-auto text-center px-4">
    <h1 class="text-4xl font-bold text-blue-700 mb-4">Bienvenue, {{ Auth::user()->name }} !</h1>
    <p class="text-xl text-blue-600 mb-8">Gérez vos informations personnelles et vos paramètres.</p>
  </div>
</section>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row items-center md:items-start">
      <!-- Photo de profil -->
      @if(\Laravel\Jetstream\Jetstream::managesProfilePhotos())
      <div class="flex-shrink-0">
        <img class="w-32 h-32 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
      </div>
      @endif
      
      <!-- Informations et Actions -->
      <div class="mt-4 md:mt-0 md:ml-6 w-full">
        <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
        <p class="text-gray-600 mb-2"><strong>Email :</strong> {{ Auth::user()->email }}</p>
        <p class="text-gray-600 mb-2"><strong>Type :</strong> {{ ucfirst(Auth::user()->user_type) }}</p>
        
        <!-- Boutons d'action -->
        <div class="mt-4 flex flex-wrap gap-4">
          <a href="{{ route('profile.show') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Modifier le Profil
          </a>
          <a href="{{ route('password.edit') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Changer le Mot de Passe
          </a>
          {{-- Supprimer le compte (optionnel) --}}
        </div>
      </div>
    </div>
    
    <!-- Section Complémentaire (exemple: Favoris, Notifications) -->
    <div class="mt-8">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Informations complémentaires</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-gray-50 rounded p-4 text-center">
          <h4 class="font-bold mb-2 text-gray-700">Favoris</h4>
          <p class="text-gray-600">Vous avez {{ Auth::user()->favorites->count() }} éléments favoris.</p>
        </div>
        <!-- Vous pouvez ajouter d'autres blocs -->
      </div>
    </div>
  </div>

  @if(Auth::user()->is_provider && Auth::user()->serviceProvider)
    <!-- Section Mes Stages -->
    <div class="bg-white rounded-lg shadow p-6 mt-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Mes Stages</h2>
      @if($stages->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($stages as $stage)
            <div class="bg-gray-100 rounded p-4">
              <h3 class="text-xl font-bold mb-2">{{ $stage->name }}</h3>
              <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($stage->description, 80) }}</p>
              <p class="text-gray-600 mt-2">
                Du {{ \Carbon\Carbon::parse($stage->date_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($stage->date_end)->format('d/m/Y') }}
              </p>
              <div class="mt-4 flex space-x-2">
                <a href="{{ route('stages.edit', $stage->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">
                  Modifier
                </a>
                <form action="{{ route('stages.destroy', $stage->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression ?')" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">
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

    <!-- Section Mes Promotions -->
    <div class="bg-white rounded-lg shadow p-6 mt-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Mes Promotions</h2>
      @if($promotions->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($promotions as $promotion)
            <div class="bg-gray-100 rounded p-4">
              <h3 class="text-xl font-bold mb-2">{{ $promotion->title }}</h3>
              <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($promotion->description, 80) }}</p>
              <p class="text-gray-600 mt-2">
                Du {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
              </p>
              <div class="mt-4 flex space-x-2">
                <a href="{{ route('promotions.edit', $promotion->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm">
                  Modifier
                </a>
                <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression ?')" class="inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm">
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

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
          <a href="{{ route('password.update') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Changer le Mot de Passe
          </a>
          <!-- Si vous n'avez pas une route "account.delete", vous pouvez la supprimer de la page
               ou créer cette route. Pour l'instant, on la retire pour éviter l'erreur. -->
          {{-- <a href="{{ route('account.delete') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
            Supprimer le Compte
          </a> --}}
        </div>
      </div>
    </div>
    
    <!-- Section Complémentaire -->
    <div class="mt-8">
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Informations complémentaires</h3>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <!-- Exemple: Bloc Favoris -->
        <div class="bg-gray-50 rounded p-4 text-center">
          <h4 class="font-bold mb-2 text-gray-700">Favoris</h4>
          <p class="text-gray-600">Vous avez {{ Auth::user()->favorites->count() }} éléments favoris.</p>
        </div>
        <!-- Vous pouvez ajouter d'autres blocs (par exemple, notifications, historique d'achats, etc.) -->
      </div>
    </div>
  </div>
</div>
@endsection

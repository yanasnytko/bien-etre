@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Modifier Mon Profil</h1>
    
    {{-- Affichage des erreurs de validation, si présentes --}}
    @if ($errors->any())
      <div class="mb-4">
        <ul class="list-disc list-inside text-red-600">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <!-- Prénom -->
      <div class="mb-4">
        <label for="firstname" class="block font-semibold mb-1">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="{{ old('firstname', Auth::user()->firstname) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <!-- Nom -->
      <div class="mb-4">
        <label for="lastname" class="block font-semibold mb-1">Nom</label>
        <input type="text" name="lastname" id="lastname" value="{{ old('lastname', Auth::user()->lastname) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <!-- Adresse Email -->
      <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Adresse Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      
      <!-- Photo de Profil (si la fonctionnalité est activée via Jetstream) -->
      @if(\Laravel\Jetstream\Jetstream::managesProfilePhotos())
      <div class="mb-4">
        <label for="profile_photo" class="block font-semibold mb-1">Photo de Profil</label>
        <input type="file" name="profile_photo" id="profile_photo"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @if (Auth::user()->profile_photo_path)
          <div class="mt-2">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-20 h-20 rounded-full">
          </div>
        @endif
      </div>
      @endif

      <!-- Bouton de soumission -->
      <div>
        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Enregistrer les modifications
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

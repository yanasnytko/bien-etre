@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Modifier Mon Profil</h1>
    
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

      <!-- Infos personnelles -->
      <div class="mb-4">
        <label for="firstname" class="block font-semibold mb-1">Prénom</label>
        <input type="text" name="firstname" id="firstname" value="{{ old('firstname', Auth::user()->firstname) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      <div class="mb-4">
        <label for="lastname" class="block font-semibold mb-1">Nom</label>
        <input type="text" name="lastname" id="lastname" value="{{ old('lastname', Auth::user()->lastname) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Adresse Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <!-- Gestion de la photo de profil si activée -->
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

      <!-- Gestion de l'adresse -->
      <h2 class="text-xl font-bold text-gray-800 mt-6 mb-4">Adresse</h2>
      <div class="mb-4">
        <label for="street" class="block font-semibold mb-1">Rue</label>
        <input type="text" name="street" id="street" value="{{ old('street', Auth::user()->address->street ?? '') }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      <div class="mb-4">
        <label for="number" class="block font-semibold mb-1">Numéro</label>
        <input type="text" name="number" id="number" value="{{ old('number', Auth::user()->address->number ?? '') }}"
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      
      <!-- Si vous avez une relation vers la localité via un champ localite_id dans la table addresses, vous pouvez ajouter un select -->
      <div class="mb-4">
        <label for="localite_id" class="block font-semibold mb-1">Localité</label>
        <select name="localite_id" id="localite_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          <option value="">-- Sélectionnez une localité --</option>
          @foreach($localites as $localite)
            <option value="{{ $localite->id }}"
              {{ old('localite_id', Auth::user()->address->localite_id ?? '') == $localite->id ? 'selected' : '' }}>
              {{ $localite->city }}
            </option>
          @endforeach
        </select>
      </div>

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

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="bg-white rounded-lg shadow p-6 max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Modifier Mon Profil</h1>
    
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <!-- Formulaire principal pour modifier les informations de l'utilisateur -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <!-- Informations générales -->
      <div class="mb-4">
        <label for="firstname" class="block font-semibold mb-1">Prénom</label>
        <input id="firstname" type="text" name="firstname" value="{{ old('firstname', Auth::user()->firstname) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      <div class="mb-4">
        <label for="lastname" class="block font-semibold mb-1">Nom</label>
        <input id="lastname" type="text" name="lastname" value="{{ old('lastname', Auth::user()->lastname) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>
      <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <!-- Photo de profil (si activé) -->
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

      <!-- Section additionnelle pour Prestataires -->
      @if(Auth::user()->is_provider)
        <div class="border p-4 rounded mb-4">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Informations de Prestataire</h2>

          <div class="mb-4">
            <label for="company_name" class="block font-semibold mb-1">Nom de l'entreprise</label>
            <input type="text" name="company_name" id="company_name" value="{{ old('company_name', Auth::user()->serviceProvider->company_name ?? '') }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          </div>

          <div class="mb-4">
            <label for="website" class="block font-semibold mb-1">Site web</label>
            <input type="url" name="website" id="website" value="{{ old('website', Auth::user()->serviceProvider->website ?? '') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          </div>

          <div class="mb-4">
            <label for="vat_number" class="block font-semibold mb-1">Numéro de TVA</label>
            <input type="text" name="vat_number" id="vat_number" value="{{ old('vat_number', Auth::user()->serviceProvider->vat_number ?? '') }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          </div>

          <div class="mb-4">
            <label for="telephone" class="block font-semibold mb-1">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone', Auth::user()->serviceProvider->telephone ?? '') }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          </div>

          <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description de l'entreprise</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description', Auth::user()->serviceProvider->description ?? '') }}</textarea>
          </div>

          <!-- Champs pour la sélection des catégories existantes -->
          <div class="mb-4">
            <p class="mb-2 font-semibold text-gray-700">Catégories que vous proposez :</p>
            @foreach($services as $service)
              <label class="inline-flex items-center mr-4">
                <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                  @if(Auth::user()->serviceProvider && Auth::user()->serviceProvider->services->contains($service->id))
                    checked
                  @endif
                  class="mr-1">
                <span>{{ $service->name }}</span>
              </label>
            @endforeach
          </div>

          <!-- Champ pour proposer une nouvelle catégorie -->
          <div class="mb-4">
            <label for="new_category" class="block font-semibold mb-1">Proposer une nouvelle catégorie</label>
            <input type="text" name="new_category" id="new_category" placeholder="Nom de la nouvelle catégorie"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
          </div>
        </div>
      @endif

      @if(\Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mb-4">
          <label class="flex items-center">
            <input type="checkbox" name="terms" id="terms" class="mr-2" required>
            <span class="text-gray-600 text-sm">
              J'accepte les <a href="{{ route('terms.show') }}" class="text-blue-600 hover:underline">Conditions d'utilisation</a>
              et la <a href="{{ route('policy.show') }}" class="text-blue-600 hover:underline">Politique de confidentialité</a>
            </span>
          </label>
        </div>
      @endif

      <div class="mb-4">
        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Enregistrer les modifications
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

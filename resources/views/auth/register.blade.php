@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center" x-data="{ userType: '{{ old('user_type', 'user') }}' }">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-lg">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Inscription</h1>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Informations personnelles (firstname, lastname, email, password, etc.) -->
      <div class="mb-4">
        <label for="firstname" class="block font-semibold mb-1">Prénom</label>
        <input id="firstname" type="text" name="firstname" value="{{ old('firstname') }}" required autofocus
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('firstname')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="lastname" class="block font-semibold mb-1">Nom</label>
        <input id="lastname" type="text" name="lastname" value="{{ old('lastname') }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('lastname')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Adresse Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="password" class="block font-semibold mb-1">Mot de passe</label>
        <input id="password" type="password" name="password" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-4">
        <label for="password_confirmation" class="block font-semibold mb-1">Confirmer le mot de passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <!-- Choix du type de compte -->
      <div class="mb-4">
        <span class="block font-semibold mb-1">Type de compte</span>
        <label class="inline-flex items-center mr-4">
          <input type="radio" name="user_type" x-model="userType" value="user" {{ old('user_type', 'user') == 'user' ? 'checked' : '' }} class="mr-2">
          <span>User</span>
        </label>
        <label class="inline-flex items-center">
          <input type="radio" name="user_type" x-model="userType" value="provider" {{ old('user_type') == 'provider' ? 'checked' : '' }} class="mr-2">
          <span>Prestataire</span>
        </label>
        @error('user_type')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Section additionnelle pour Prestataire -->
      <template x-if="userType === 'provider'">
        <div class="border p-4 rounded mb-4">
          <h2 class="text-xl font-bold text-gray-800 mb-4">Informations pour Prestataire</h2>

          <!-- Champs supplémentaires pour le prestataire -->
          <div class="mb-4">
            <label for="company_name" class="block font-semibold mb-1">Nom de l'entreprise</label>
            <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
            @error('company_name')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="website" class="block font-semibold mb-1">Site web</label>
            <input type="url" name="website" id="website" value="{{ old('website') }}"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
            @error('website')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="vat_number" class="block font-semibold mb-1">Numéro de TVA</label>
            <input type="text" name="vat_number" id="vat_number" value="{{ old('vat_number') }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
            @error('vat_number')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="telephone" class="block font-semibold mb-1">Téléphone</label>
            <input type="text" name="telephone" id="telephone" value="{{ old('telephone') }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
            @error('telephone')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4">
            <label for="description" class="block font-semibold mb-1">Description de l'entreprise</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('description') }}</textarea>
            @error('description')
              <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Champs pour la sélection des catégories existantes -->
          <div class="mb-4">
            <p class="mb-2 font-semibold text-gray-700">Sélectionnez les catégories que vous proposez :</p>
            @foreach($services as $service)
              <label class="inline-flex items-center mr-4">
                <input type="checkbox" name="service_ids[]" value="{{ $service->id }}" class="mr-1">
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
      </template>

      @if(\Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
        <div class="mb-4">
          <label class="flex items-center">
            <input type="checkbox" name="terms" id="terms" class="mr-2" required>
            <span class="text-gray-600 text-sm">
              J'accepte les <a href="{{ route('terms.show') }}" class="text-blue-600 hover:underline">Conditions d'utilisation</a> et la
              <a href="{{ route('policy.show') }}" class="text-blue-600 hover:underline">Politique de confidentialité</a>
            </span>
          </label>
        </div>
      @endif

      <div class="mb-4">
        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          S'inscrire
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Changer le Mot de Passe</h1>

    <!-- Affiche éventuellement un message de succès ou d'erreur -->
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('user.password.update') }}" method="POST">
      @csrf
      @method('PATCH')

      <div class="mb-4">
        <label for="current_password" class="block font-semibold mb-1">Mot de passe actuel</label>
        <input type="password" name="current_password" id="current_password" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('current_password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="block font-semibold mb-1">Nouveau mot de passe</label>
        <input type="password" name="password" id="password" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password_confirmation" class="block font-semibold mb-1">Confirmer le nouveau mot de passe</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div>
        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Mettre à jour le mot de passe
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

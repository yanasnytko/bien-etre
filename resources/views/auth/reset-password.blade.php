@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Réinitialiser le Mot de Passe</h1>

    <form method="POST" action="{{ route('user.password.update') }}">
      @csrf

      <!-- Le token de réinitialisation doit être inclus -->
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Adresse Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password" class="block font-semibold mb-1">Nouveau Mot de Passe</label>
        <input id="password" type="password" name="password" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label for="password_confirmation" class="block font-semibold mb-1">Confirmer le Nouveau Mot de Passe</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
      </div>

      <div>
        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
          Réinitialiser le mot de passe
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

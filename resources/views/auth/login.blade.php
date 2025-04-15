@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Connexion</h1>

    @if(session('status'))
      <div class="mb-4 text-green-600">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email -->
      <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Adresse Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Mot de passe -->
      <div class="mb-4">
        <label for="password" class="block font-semibold mb-1">Mot de passe</label>
        <input id="password" type="password" name="password" required
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('password')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Souvenir de moi -->
      <div class="mb-4 flex items-center">
        <input type="checkbox" name="remember" id="remember" class="mr-2">
        <label for="remember" class="text-gray-600">Se souvenir de moi</label>
      </div>

      <div class="mb-4">
        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Connexion
        </button>
      </div>

      <div class="text-center">
        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
          Mot de passe oublié ?
        </a>
      </div>
    </form>
  </div>
</div>
@endsection

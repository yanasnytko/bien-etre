@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Mot de passe oublié</h1>
    <p class="text-gray-600 text-center mb-4">Entrez votre adresse email pour recevoir un lien de réinitialisation.</p>
    
    @if(session('status'))
      <div class="mb-4 text-green-600 text-center">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="block font-semibold mb-1">Adresse Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
               class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Envoyer le lien de réinitialisation
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

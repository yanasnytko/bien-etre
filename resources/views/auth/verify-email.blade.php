@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-center">
  <div class="bg-white rounded-lg shadow p-6 w-full max-w-md text-center">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Vérifiez votre Adresse Email</h1>
    <p class="text-gray-600 mb-4">
      Avant de continuer, veuillez vérifier votre boîte email pour un lien de vérification.
      Si vous n'avez pas reçu l'e-mail, cliquez ci-dessous pour en recevoir un autre.
    </p>
    
    @if(session('status') == 'verification-link-sent')
      <div class="mb-4 text-green-600">
        Un nouveau lien de vérification vous a été envoyé.
      </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Renvoyer le lien de vérification
      </button>
    </form>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <!-- Bouton de retour -->
  <a href="{{ route('service-providers.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row">
      <!-- Section image / logo -->
      <div class="md:w-1/3 flex-shrink-0">
        @if($serviceProvider->logo)
          <img src="{{ $serviceProvider->logo }}" alt="{{ $serviceProvider->company_name }}" class="w-full h-auto rounded">
        @else
          <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
            <span class="text-gray-500">Pas d'image</span>
          </div>
        @endif
      </div>
      <!-- Détails du prestataire -->
      <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $serviceProvider->company_name }}</h1>
        <p class="text-gray-600 mb-2"><strong>Email :</strong> {{ $serviceProvider->company_email }}</p>
        <p class="text-gray-600 mb-2"><strong>Téléphone :</strong> {{ $serviceProvider->telephone }}</p>
        <p class="text-gray-600 mb-2"><strong>Site Web :</strong> <a href="{{ $serviceProvider->website }}" class="text-blue-600 hover:underline">{{ $serviceProvider->website }}</a></p>
        @if($serviceProvider->description)
          <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-1">Description</h2>
            <p class="text-gray-600">{{ $serviceProvider->description }}</p>
          </div>
        @endif
        @if($serviceProvider->services && $serviceProvider->services->isNotEmpty())
          <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-1">Catégories associées</h2>
            <ul class="list-disc list-inside text-gray-600">
              @foreach($serviceProvider->services as $service)
              <li>
                <a href="{{ route('services.show', $service->id) }}" class="text-blue-600 hover:underline">
                  {{ $service->name }}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        @endif
        
      </div>
    </div>
  </div>

  <!-- Section des Stages -->
  <div class="bg-white rounded-lg shadow p-6 mb-8 mt-5">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Stages proposés</h2>
    @if($serviceProvider->stages->isNotEmpty())
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($serviceProvider->stages as $stage)
          <div class="bg-gray-100 rounded p-4">
            <h3 class="text-xl font-bold mb-2">{{ $stage->name }}</h3>
            <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($stage->description, 100) }}</p>
            <p class="text-gray-600 mt-2">
              Du {{ \Carbon\Carbon::parse($stage->date_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($stage->date_end)->format('d/m/Y') }}
            </p>
            <a href="{{ route('stages.show', $stage->id) }}" class="mt-4 inline-block text-blue-600 hover:underline">
              En savoir plus
            </a>
          </div>
        @endforeach
      </div>
    @else
      <p>Aucun stage n'est proposé actuellement.</p>
    @endif
  </div>

  <!-- Section des Promotions -->
  <div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Promotions</h2>
    @if($serviceProvider->promotions->isNotEmpty())
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($serviceProvider->promotions as $promotion)
          <div class="bg-gray-100 rounded p-4">
            <h3 class="text-xl font-bold mb-2">{{ $promotion->title }}</h3>
            <p class="text-gray-700">{{ \Illuminate\Support\Str::limit($promotion->description, 100) }}</p>
            <p class="text-gray-600 mt-2">
              Du {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
            </p>
            <a href="{{ route('promotions.show', $promotion->id) }}" class="mt-4 inline-block text-blue-600 hover:underline">
              En savoir plus
            </a>
          </div>
        @endforeach
      </div>
    @else
      <p>Aucune promotion n'est proposée actuellement.</p>
    @endif
  </div>

  <!-- Section Commentaires -->
    <section class="mt-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Commentaires</h2>

    <!-- Formulaire pour ajouter un commentaire (visible uniquement pour les utilisateurs authentifiés) -->
    @auth
        <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
        @csrf
        <!-- On suppose que le champ service_provider_id relie le commentaire au prestataire -->
        <input type="hidden" name="service_provider_id" value="{{ $serviceProvider->id }}">
        <div class="mb-4">
            <label for="title" class="block font-semibold mb-1">Titre du commentaire</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">
            @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="content" class="block font-semibold mb-1">Votre commentaire</label>
            <textarea name="content" id="content" rows="4"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:border-blue-600">{{ old('content') }}</textarea>
            @error('content')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Envoyer le commentaire
            </button>
        </div>
        </form>
    @else
        <p class="mb-6">Veuillez <a href="{{ route('login') }}" class="text-blue-600 hover:underline">vous connecter</a> pour laisser un commentaire.</p>
    @endauth

    <!-- Affichage de la liste des commentaires -->
    @if($serviceProvider->comments && $serviceProvider->comments->count() > 0)
        @foreach($serviceProvider->comments as $comment)
        <div class="bg-gray-100 rounded p-4 mb-4">
            <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-800">{{ $comment->title }}</h3>
            @auth
                <!-- Bouton ou formulaire pour signaler un commentaire -->
                <form action="{{ route('comments.report', $comment->id) }}" method="POST" onsubmit="return confirm('Souhaitez-vous signaler ce commentaire ?')">
                @csrf
                <button type="submit" class="text-red-600 hover:underline text-sm">Signaler</button>
                </form>
            @endauth
            </div>
            <p class="text-gray-700">{{ $comment->content }}</p>
            <p class="text-sm text-gray-500 mt-2">
            Posté par {{ $comment->user->name ?? 'Anonyme' }} le {{ $comment->created_at->format('d/m/Y') }}
            </p>
        </div>
        @endforeach
    @else
        <p>Aucun commentaire pour l'instant.</p>
    @endif
    </section>

</div>
@endsection

@extends('layouts.app')

{{-- Section hero affichée uniquement sur la page d'accueil --}}
@section('hero')
<section class="bg-blue-50 py-12">
  <div class="container mx-auto text-center px-4">
    <h1 class="text-4xl font-bold text-blue-700 mb-4">Bienvenue sur l'Annuaire Bien-Être</h1>
    <p class="text-xl text-blue-600 mb-8">Découvrez les meilleurs prestataires de bien-être près de chez vous.</p>
    <a href="{{ route('service-providers.index') }}" class="px-6 py-3 bg-blue-500 text-white rounded-full hover:bg-blue-700 transition">
      Explorer nos Prestataires
    </a>
  </div>
</section>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">

  <!-- Section "Nos Prestataires" -->
  <section class="mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Nos Prestataires</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($serviceProviders as $provider)
        <div class="bg-white rounded-lg shadow p-4 flex flex-col">
          {{-- Affichage de l'image ou logo --}}
          <div class="mb-2">
            @if($provider->logo)
              <img src="{{ $provider->logo }}" alt="{{ $provider->company_name }}" class="w-full h-32 object-cover rounded">
            @else
              <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center">
                <span class="text-gray-500">Pas d'image</span>
              </div>
            @endif
          </div>
          <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $provider->company_name }}</h3>
          <a href="{{ route('service-providers.show', $provider->id) }}" class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir plus
          </a>
        </div>
      @endforeach
    </div>
    <div class="mt-8 text-center">
      <a href="{{ route('service-providers.index') }}" class="text-blue-600 hover:underline">
        Voir tous les prestataires
      </a>
    </div>
  </section>

  <!-- Section "Nos Services" -->
  <section class="mb-12">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Nos Services</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($services as $service)
        <div class="bg-white rounded-lg shadow p-4 flex flex-col">
          <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $service->name }}</h3>
          <p class="text-gray-600 text-sm mb-2">{{ \Illuminate\Support\Str::limit($service->description, 80) }}</p>
          <a href="{{ route('services.show', $service->id) }}" class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir plus
          </a>
        </div>
      @endforeach
    </div>
    <div class="mt-8 text-center">
      <a href="{{ route('services.index') }}" class="text-blue-600 hover:underline">
        Voir tous les services
      </a>
    </div>
  </section>

  <!-- Section "Promotions Actuelles" -->
  <section>
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Promotions Actuelles</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach($promotions as $promotion)
        <div class="bg-white rounded-lg shadow p-4 flex flex-col">
          <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $promotion->title }}</h3>
          <p class="text-gray-600 text-sm mb-2">
            Du {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }}
            au {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
          </p>
          <a href="{{ route('promotions.show', $promotion->id) }}" class="mt-auto inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir plus
          </a>
        </div>
      @endforeach
    </div>
    <div class="mt-8 text-center">
      <a href="{{ route('promotions.index') }}" class="text-blue-600 hover:underline">
        Voir toutes les promotions
      </a>
    </div>
  </section>
</div>
@endsection

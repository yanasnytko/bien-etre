@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('services.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>
  
  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $service->name }}</h1>

    @if($service->featured)
      <div class="mb-4">
        <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-200 text-green-800 rounded">En vedette</span>
      </div>
    @endif

    @if($service->description)
      <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
        <p class="text-gray-600">{{ $service->description }}</p>
      </div>
    @else
      <p class="text-gray-600">Aucune description disponible.</p>
    @endif
  </div>

  <div class="bg-white rounded-lg shadow p-6 mt-5">
    <h2 class="text-2xl font-bold mb-4">Prestataires proposant ce service</h2>

    @if($service->serviceProviders->isNotEmpty())
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($service->serviceProviders as $provider)
          <div class="bg-gray-100 rounded p-4">
            <!-- Vous pouvez afficher une image, le nom et d'autres infos du prestataire -->
            <h3 class="text-xl font-bold mb-2">{{ $provider->company_name }}</h3>
            <p class="text-gray-600 text-sm mb-2">{{ $provider->description }}</p>
            <a href="{{ route('service-providers.show', $provider->id) }}"
               class="text-blue-600 hover:underline text-sm">
               Voir le profil
            </a>
          </div>
        @endforeach
      </div>
      <div class="mt-4">
        {{ $serviceProviders->links() }}
      </div>
    @else
      <p>Aucun prestataire ne propose ce service actuellement.</p>
    @endif
  </div>
</div>
@endsection

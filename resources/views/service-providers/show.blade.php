@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('service-providers.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row">
      <div class="md:w-1/3">
        @if($serviceProvider->logo)
          <img src="{{ $serviceProvider->logo }}" alt="{{ $serviceProvider->company_name }}" class="w-full h-auto rounded">
        @else
          <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
            <span class="text-gray-500">Pas d'image</span>
          </div>
        @endif
      </div>
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
                <li>{{ $service->name }}</li>
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

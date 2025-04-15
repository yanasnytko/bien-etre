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
</div>
@endsection

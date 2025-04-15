@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Nos Services</h1>
    <a href="{{ route('services.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
      Ajouter un Service
    </a>
  </div>
  
  <!-- Grille responsive de cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($services as $service)
      <div class="bg-white rounded-lg shadow p-4 flex flex-col">
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $service->name }}</h3>
        
        @if($service->description)
          <p class="text-gray-600 text-sm mb-2">{{ \Illuminate\Support\Str::limit($service->description, 80) }}</p>
        @else
          <p class="text-gray-600 text-sm mb-2">Pas de description.</p>
        @endif

        @if($service->featured)
          <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-200 text-green-800 rounded mb-2">En vedette</span>
        @endif

        <div class="mt-auto flex space-x-2">
          <a href="{{ route('services.show', $service->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir
          </a>
          <a href="{{ route('services.edit', $service->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
            Modifier
          </a>
          <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression de ce service ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
              Supprimer
            </button>
          </form>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Pagination -->
  <div class="mt-8">
    {{ $services->links() }}
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Nos Stages</h1>
    <a href="{{ route('stages.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
      Ajouter un Stage
    </a>
  </div>
  
  <!-- Grille responsive de cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($stages as $stage)
      <div class="bg-white rounded-lg shadow p-4 flex flex-col">
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $stage->name }}</h3>
        
        <!-- Image ou placeholder -->
        @if($stage->image)
          <img src="{{ $stage->image }}" alt="{{ $stage->name }}" class="w-full h-32 object-cover rounded mb-2">
        @else
          <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center mb-2">
            <span class="text-gray-500">Pas d'image</span>
          </div>
        @endif

        <!-- Dates du stage -->
        <p class="text-sm text-gray-600 mb-2">
          <strong>Date :</strong>
          {{ \Carbon\Carbon::parse($stage->date_start)->format('d/m/Y') }}
           - 
          {{ \Carbon\Carbon::parse($stage->date_end)->format('d/m/Y') }}
        </p>
        
        <!-- Coût et devise -->
        <p class="text-sm text-gray-600 mb-2">
          <strong>Coût :</strong> {{ $stage->cost }} {{ $stage->currency }}
        </p>
        
        <!-- Description tronquée -->
        <p class="text-gray-600 text-sm mb-4">
          {{ \Illuminate\Support\Str::limit($stage->description, 80) }}
        </p>
        
        <!-- Boutons d'action -->
        <div class="mt-auto flex space-x-2">
          <a href="{{ route('stages.show', $stage->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir
          </a>
          <!-- <a href="{{ route('stages.edit', $stage->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
            Modifier
          </a>
          <form action="{{ route('stages.destroy', $stage->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression de ce stage ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
              Supprimer
            </button>
          </form> -->
        </div>
      </div>
    @endforeach
  </div>
  
  <!-- Pagination -->
  <div class="mt-8">
    {{ $stages->links() }}
  </div>
</div>
@endsection

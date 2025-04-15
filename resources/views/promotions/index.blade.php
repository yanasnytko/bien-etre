@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Nos Promotions</h1>
    <a href="{{ route('promotions.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
      Ajouter une Promotion
    </a>
  </div>
  
  <!-- Grille responsive de promotions -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($promotions as $promotion)
      <div class="bg-white rounded-lg shadow p-4 flex flex-col">
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $promotion->title }}</h3>
        
        <!-- Affichage du PDF disponible -->
        @if($promotion->pdf)
          <p class="text-sm text-gray-600 mb-2">
            <strong>PDF :</strong> Disponible
          </p>
        @else
          <p class="text-sm text-gray-600 mb-2">
            <strong>PDF :</strong> Non disponible
          </p>
        @endif

        <!-- Dates de la promotion -->
        <p class="text-sm text-gray-600 mb-2">
          <strong>Du :</strong> {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }}<br>
          <strong>Au :</strong> {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
        </p>

        <!-- Dates d'affichage -->
        <p class="text-sm text-gray-600 mb-2">
          <strong>Affichage :</strong><br>
          Du {{ \Carbon\Carbon::parse($promotion->display_start)->format('d/m/Y') }} <br>
          au {{ \Carbon\Carbon::parse($promotion->display_end)->format('d/m/Y') }}
        </p>
        
        <!-- Description tronquée -->
        <p class="text-gray-600 text-sm mb-4">
          {{ \Illuminate\Support\Str::limit($promotion->description, 100) }}
        </p>

        <div class="mt-auto flex space-x-2">
          <a href="{{ route('promotions.show', $promotion->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir
          </a>
          <!--<a href="{{ route('promotions.edit', $promotion->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
            Modifier
          </a> -->
          <!-- Formulaire de suppression avec confirmation -->
          <!--<form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
              Supprimer
            </button>
          </form>-->
        </div>
      </div>
    @endforeach
  </div>
  
  <!-- Pagination -->
  <div class="mt-8">
    {{ $promotions->links() }}
  </div>
</div>
@endsection

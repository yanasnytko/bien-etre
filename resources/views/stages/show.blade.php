@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('stages.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <div class="flex flex-col md:flex-row">
      <!-- Section Image -->
      <div class="md:w-1/3">
        @if($stage->image)
          <img src="{{ $stage->image }}" alt="{{ $stage->name }}" class="w-full h-auto rounded">
        @else
          <div class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
            <span class="text-gray-500">Pas d'image</span>
          </div>
        @endif
      </div>
      <!-- Détails -->
      <div class="md:w-2/3 md:pl-6 mt-4 md:mt-0">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $stage->name }}</h1>
        <p class="text-gray-600 mb-2">
          <strong>Date :</strong> Du {{ \Carbon\Carbon::parse($stage->date_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($stage->date_end)->format('d/m/Y') }}
        </p>
        <p class="text-gray-600 mb-2">
          <strong>Coût :</strong> {{ $stage->cost }} {{ $stage->currency }}
        </p>
        @if($stage->description)
          <div class="mt-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
            <p class="text-gray-600">{{ $stage->description }}</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection

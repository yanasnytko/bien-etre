@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('promotions.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $promotion->title }}</h1>
    
    @if($promotion->pdf)
      <div class="mb-4">
        <a href="{{ asset('storage/'.$promotion->pdf) }}" target="_blank" class="text-blue-600 underline">
          Télécharger le PDF de la promotion
        </a>
      </div>
    @endif

    <div class="mb-4">
      <p class="text-gray-600">
        <strong>Période de promotion :</strong> Du {{ \Carbon\Carbon::parse($promotion->date_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($promotion->date_end)->format('d/m/Y') }}
      </p>
      <p class="text-gray-600">
        <strong>Période d'affichage :</strong> Du {{ \Carbon\Carbon::parse($promotion->display_start)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($promotion->display_end)->format('d/m/Y') }}
      </p>
    </div>

    @if($promotion->description)
      <div class="mt-4">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
        <p class="text-gray-600">{{ $promotion->description }}</p>
      </div>
    @endif
  </div>
</div>
@endsection

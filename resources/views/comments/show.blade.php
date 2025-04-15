@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <a href="{{ route('comments.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Retour</a>

  <div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $comment->title }}</h1>
    
    <p class="text-gray-600 mb-2"><strong>Contenu :</strong></p>
    <p class="text-gray-700 mb-4">{{ $comment->content }}</p>
    
    @if($comment->rating)
      <p class="text-gray-600 mb-2"><strong>Note :</strong> {{ $comment->rating }}/5</p>
    @endif

    <div class="mt-4 text-sm text-gray-500">
      <p><strong>Par :</strong> {{ $comment->user->name ?? 'Anonyme' }}</p>
      <p><strong>Le :</strong> {{ $comment->created_at->format('d/m/Y') }}</p>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Commentaires</h1>
    <a href="{{ route('comments.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
      Ajouter un Commentaire
    </a>
  </div>

  <!-- Si vous préférez une disposition en grille (cards) -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($comments as $comment)
      <div class="bg-white rounded-lg shadow p-4 flex flex-col">
        <h3 class="text-xl font-bold text-gray-700 mb-2">{{ $comment->title }}</h3>
        <p class="text-gray-600 text-sm mb-2">{{ \Illuminate\Support\Str::limit($comment->content, 80) }}</p>
        @if($comment->rating)
          <p class="text-sm text-gray-500 mb-2">Note : {{ $comment->rating }}/5</p>
        @endif
        <div class="mt-auto flex space-x-2">
          <a href="{{ route('comments.show', $comment->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            Voir
          </a>
          <a href="{{ route('comments.edit', $comment->id) }}" class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
            Modifier
          </a>
          <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Confirmez-vous la suppression de ce commentaire ?')">
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

  <!-- Liens de pagination -->
  <div class="mt-8">
    {{ $comments->links() }}
  </div>
</div>
@endsection

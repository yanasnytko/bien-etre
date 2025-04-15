@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold text-gray-800 mb-6">Signalements d'Abus</h1>
  @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
      {{ session('success') }}
    </div>
  @endif
  <table class="min-w-full bg-white shadow-md rounded">
    <thead>
      <tr>
        <th class="py-2 px-4 border-b">ID</th>
        <th class="py-2 px-4 border-b">Commentaire</th>
        <th class="py-2 px-4 border-b">Signalé par</th>
        <th class="py-2 px-4 border-b">Raison</th>
        <th class="py-2 px-4 border-b">Statut</th>
        <th class="py-2 px-4 border-b">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($abuses as $abuse)
      <tr>
        <td class="py-2 px-4 border-b">{{ $abuse->id }}</td>
        <td class="py-2 px-4 border-b">{{ $abuse->comment->title ?? 'N/A' }}</td>
        <td class="py-2 px-4 border-b">{{ $abuse->reportedBy->name ?? 'Inconnu' }}</td>
        <td class="py-2 px-4 border-b">{{ $abuse->reason }}</td>
        <td class="py-2 px-4 border-b">{{ ucfirst($abuse->status) }}</td>
        <td class="py-2 px-4 border-b">
          <a href="{{ route('abuses.show', $abuse->id) }}" class="text-blue-600 hover:underline">Voir</a>
          <form action="{{ route('abuses.destroy', $abuse->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmez-vous la suppression ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline ml-2">Supprimer</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <div class="mt-6">
    {{ $abuses->links() }}
  </div>
</div>
@endsection

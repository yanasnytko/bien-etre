@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">Administration</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white shadow p-4 rounded">
      <h2 class="text-xl font-semibold">Utilisateurs</h2>
      <p class="text-3xl">{{ $usersCount }}</p>
      <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">Gérer</a>
    </div>
    <div class="bg-white shadow p-4 rounded">
      <h2 class="text-xl font-semibold">Prestataires</h2>
      <p class="text-3xl">{{ $providersCount }}</p>
      <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">Gérer</a>
    </div>
    <div class="bg-white shadow p-4 rounded">
      <h2 class="text-xl font-semibold">Services</h2>
      <p class="text-3xl">{{ $servicesCount }}</p>
      <a href="#" class="text-blue-600 hover:underline">Gérer</a>
    </div>
    <div class="bg-white shadow p-4 rounded">
      <h2 class="text-xl font-semibold">Stages</h2>
      <p class="text-3xl">{{ $stagesCount }}</p>
      <a href="#" class="text-blue-600 hover:underline">Gérer</a>
    </div>
    <div class="bg-white shadow p-4 rounded">
      <h2 class="text-xl font-semibold">Promotions</h2>
      <p class="text-3xl">{{ $promotionsCount }}</p>
      <a href="#" class="text-blue-600 hover:underline">Gérer</a>
    </div>
  </div>
</div>
@endsection

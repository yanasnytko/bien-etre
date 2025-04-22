<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""
  />
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <title>{{ config('app.name', 'Annuaire Bien-Être') }}</title>
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')

  <script>
    window.favoriteToggle = function(id, type) {
      return {
        favorited: @json(
          auth()->check() 
            && auth()->user()->favorites()
                ->where('favoriteable_type', \App\Models\ServiceProvider::class)
                ->where('favoriteable_id', $serviceProvider->id)
                ->exists()
        ),
        toggle() {
          fetch("{{ route('favorites.toggle') }}", {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept':       'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
              favoriteable_id:   id,
              favoriteable_type: type,
            }),
          })
          .then(r => r.json())
          .then(json => {
            if (json.success) this.favorited = (json.action === 'added');
          })
          .catch(console.error);
        }
      };
    }
  </script>

</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

  <!-- Header -->
  @include('partials.header')

  <!-- Affichage des notifications flash -->
  @if(session('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="fixed bottom-4 right-4 z-50 bg-green-500 text-white px-4 py-3 rounded shadow-lg">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div x-data="{ show: true }"
         x-show="show"
         x-init="setTimeout(() => show = false, 3000)"
         class="fixed bottom-4 right-4 z-50 bg-red-500 text-white px-4 py-3 rounded shadow-lg">
      {{ session('error') }}
    </div>
  @endif

  <!-- Section Hero (optionnelle, par exemple pour la page d'accueil) -->
  @hasSection('hero')
    @yield('hero')
  @endif

  <!-- Contenu principal -->
  <main class="container mx-auto px-4 py-8">
    @yield('content')
  </main>

  <!-- Footer -->
  @include('partials.footer')

  
  <script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""
  ></script>

    <!-- Inclusion d'Alpine.js -->
  <script src="https://unpkg.com/alpinejs@3.x/dist/cdn.min.js" defer></script>
  
  @stack('scripts')

</body>
</html>

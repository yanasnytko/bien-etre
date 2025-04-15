<header class="bg-white shadow">
  <div class="container mx-auto px-4 py-4 flex items-center justify-between">
    <!-- Logo et Nom -->
    <div class="flex items-center space-x-3">
      <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600">
        <span class="text-2xl font-bold text-gray-800">{{ config('app.name', 'Annuaire Bien-Être') }}</span>
      </a>
    </div>
    <!-- Menu de navigation Desktop -->
    <nav class="hidden md:flex space-x-6">
      <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
      <a href="{{ route('service-providers.index') }}" class="text-gray-600 hover:text-blue-600">Prestataires</a>
      <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-blue-600">Services</a>
      <a href="{{ route('stages.index') }}" class="text-gray-600 hover:text-blue-600">Stages</a>
      <a href="{{ route('promotions.index') }}" class="text-gray-600 hover:text-blue-600">Promotions</a>
    </nav>
    <!-- Boutons d'authentification -->
    <div class="flex items-center space-x-4">
      @auth
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">Mon Compte</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Déconnexion</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">Connexion</a>
        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Inscription</a>
      @endauth
    </div>
    <!-- Bouton menu Mobile -->
    <div class="md:hidden">
      <button x-data="{ open: false }" @click="open = !open" class="text-gray-600 hover:text-blue-600 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
          <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>
  </div>
  <!-- Menu Mobile -->
  <div x-data="{ open: false }" x-show="open" x-cloak class="md:hidden bg-white border-t">
    <nav class="px-4 py-2 flex flex-col space-y-2">
      <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a>
      <a href="{{ route('service-providers.index') }}" class="text-gray-600 hover:text-blue-600">Prestataires</a>
      <a href="{{ route('services.index') }}" class="text-gray-600 hover:text-blue-600">Services</a>
      <a href="{{ route('stages.index') }}" class="text-gray-600 hover:text-blue-600">Stages</a>
      <a href="{{ route('promotions.index') }}" class="text-gray-600 hover:text-blue-600">Promotions</a>
      @auth
        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">Mon Compte</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">Déconnexion</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">Connexion</a>
        <a href="{{ route('register') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Inscription</a>
      @endauth
    </nav>
  </div>
</header>

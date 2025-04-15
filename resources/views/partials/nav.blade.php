<nav class="bg-white shadow mb-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div>
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                    {{ config('app.name', 'Annuaire Bien-Être') }}
                </a>
            </div>
            <div>
                <ul class="flex space-x-4">
                    <li><a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-800">Dashboard</a></li>
                    <li><a href="{{ route('service-providers.index') }}" class="text-gray-600 hover:text-gray-800">Prestataires</a></li>
                    <!-- Ajoutez d'autres liens selon vos besoins -->
                </ul>
            </div>
            <div>
                <!-- Bouton de déconnexion ou profil utilisateur -->
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800">Connexion</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="p-4 bg-white shadow rounded">
    <div class="flex flex-col sm:flex-row gap-4">
        <input type="text" wire:model.debounce.300ms="search" placeholder="Recherche..." class="border rounded p-2 flex-1">
        <input type="text" wire:model="city" placeholder="Ville" class="border rounded p-2">
        <select wire:model="category" class="border rounded p-2">
            <option value="">Toutes les catégories</option>
            <option value="massage">Massage</option>
            <option value="yoga">Yoga</option>
            <option value="nutrition">Nutrition</option>
            <!-- Ajoutez d'autres catégories selon votre besoin -->
        </select>
    </div>

    <div class="mt-4">
        @if ($serviceProviders->count())
            <ul>
                @foreach ($serviceProviders as $provider)
                    <li class="border-b py-2">{{ $provider->company_name }}</li>
                @endforeach
            </ul>
            <div class="mt-4">
                {{ $serviceProviders->links() }}
            </div>
        @else
            <p>Aucun prestataire trouvé.</p>
        @endif
    </div>
</div>

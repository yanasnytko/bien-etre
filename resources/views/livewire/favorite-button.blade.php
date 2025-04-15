<button wire:click="toggleFavorite" class="text-xl focus:outline-none">
    @if($isFavorited)
        <span class="text-yellow-500">&#9733;</span> <!-- Étoile pleine -->
    @else
        <span class="text-gray-400">&#9734;</span> <!-- Étoile vide -->
    @endif
</button>

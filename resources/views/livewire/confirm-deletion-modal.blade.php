<div x-data="{ open: @entangle('showModal') }" x-cloak>
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl mb-4">Confirmer la suppression</h2>
            <p class="mb-4">Êtes-vous sûr de vouloir supprimer cet élément ?</p>
            <div class="flex justify-end space-x-4">
                <button wire:click="confirmDeletion" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Confirmer</button>
                <button @click="open = false" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Annuler</button>
            </div>
        </div>
    </div>
</div>

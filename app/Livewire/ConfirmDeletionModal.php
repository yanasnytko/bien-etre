<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfirmDeletionModal extends Component
{
    public $showModal = false;
    public $itemId; // ID de l'élément à supprimer

    public function confirmDeletion()
    {
        // Émet un événement vers le parent qui supprimera l'élément
        $this->emit('deleteItem', $this->itemId);
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.confirm-deletion-modal');
    }
}

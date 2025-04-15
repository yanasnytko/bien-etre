<?php

namespace App\Http\Livewire;

use App\Models\ServiceProvider;
use Livewire\Component;
use Livewire\WithPagination;

class SearchFilter extends Component
{
    use WithPagination;

    public $category = '';
    public $city = '';
    public $search = '';

    // Pour supprimer la pagination dans l'URL des filtres Livewire
    protected $updatesQueryString = ['category', 'city', 'search'];

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingCity()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Exemple de logique de recherche, adapte la requête en fonction de ta structure de modèle
        $serviceProviders = ServiceProvider::query()
            ->when($this->category, function($query) {
                $query->where('category', $this->category);
            })
            ->when($this->city, function($query) {
                $query->where('city', $this->city);
            })
            ->when($this->search, function($query) {
                $query->where('company_name', 'like', '%'.$this->search.'%');
            })
            ->paginate(10);

        return view('livewire.search-filter', compact('serviceProviders'));
    }
}

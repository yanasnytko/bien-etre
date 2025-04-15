<?php

namespace App\Http\Livewire;

use App\Models\ServiceProvider;
use Livewire\Component;
use Livewire\WithPagination;

class ServiceProviderList extends Component
{
    use WithPagination;

    public function render()
    {
        $serviceProviders = ServiceProvider::paginate(10);
        return view('livewire.service-provider-list', compact('serviceProviders'));
    }
}

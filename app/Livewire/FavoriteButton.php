<?php

namespace App\Http\Livewire;

use App\Models\Favorite;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FavoriteButton extends Component
{
    public $serviceProviderId;
    public $isFavorited;

    public function mount($serviceProviderId)
    {
        $this->serviceProviderId = $serviceProviderId;
        $this->isFavorited = Auth::check() && Favorite::where('user_id', Auth::id())
                                      ->where('service_provider_id', $serviceProviderId)
                                      ->exists();
    }

    public function toggleFavorite()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->isFavorited) {
            Favorite::where('user_id', Auth::id())
                     ->where('service_provider_id', $this->serviceProviderId)
                     ->delete();
            $this->isFavorited = false;
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'service_provider_id' => $this->serviceProviderId,
            ]);
            $this->isFavorited = true;
        }
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}

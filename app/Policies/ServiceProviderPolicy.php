<?php

namespace App\Policies;

use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceProviderPolicy
{
    use HandlesAuthorization;

    /**
     * Vérifie si l'utilisateur peut mettre à jour ce prestataire.
     */
    public function update(User $user, ServiceProvider $serviceProvider)
    {
        // Exemple simple : seul le propriétaire (celui dont l'ID correspond au champ user_id) peut modifier
        return $user->id === $serviceProvider->user_id;
    }

    /**
     * Vérifie si l'utilisateur peut supprimer ce prestataire.
     */
    public function delete(User $user, ServiceProvider $serviceProvider)
    {
        // Exemple simple : seul le propriétaire peut supprimer
        return $user->id === $serviceProvider->user_id;
    }

    // Tu peux ajouter d'autres méthodes pour "view", "create", etc., selon tes besoins.
}

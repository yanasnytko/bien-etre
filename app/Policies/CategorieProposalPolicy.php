<?php

namespace App\Policies;

use App\Models\CategorieProposal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategorieProposalPolicy
{
    use HandlesAuthorization;

    /**
     * Autorise la modification d'une proposition de catégorie.
     */
    public function update(User $user, CategorieProposal $proposal)
    {
        // Par exemple, seul le prestataire qui a soumis la proposition peut la modifier.
        return $user->id === $proposal->user_id;
    }

    /**
     * Autorise la suppression d'une proposition de catégorie.
     */
    public function delete(User $user, CategorieProposal $proposal)
    {
        return $user->id === $proposal->user_id;
    }
}

<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Autorise l'utilisateur à modifier le commentaire.
     */
    public function update(User $user, Comment $comment)
    {
        // Par exemple, autoriser uniquement l'auteur du commentaire
        return $user->id === $comment->user_id;
    }

    /**
     * Autorise l'utilisateur à supprimer le commentaire.
     */
    public function delete(User $user, Comment $comment)
    {
        // Ici, vous pouvez ajouter une condition pour autoriser les modérateurs également
        return $user->id === $comment->user_id;
    }
}

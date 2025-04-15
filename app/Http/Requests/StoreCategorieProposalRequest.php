<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieProposalRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Autorise pour l'instant tous les utilisateurs, ou vérifie ici si l'utilisateur est bien un prestataire.
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'       => 'required|exists:users,id',
            'proposed_name' => 'required|string|max:255',
            'description'   => 'nullable|string',
            // Le status est défini à 'pending' par défaut côté back-end.
        ];
    }
}

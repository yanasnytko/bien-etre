<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategorieProposalRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Tu peux ajouter une logique ici pour vérifier que l'utilisateur est autorisé à modifier cette proposition.
        return true;
    }

    public function rules(): array
    {
        return [
            'proposed_name' => 'required|string|max:255',
            'description'   => 'nullable|string',
            // Optionnellement, tu peux autoriser la modification du status par un administrateur.
            'status'        => 'in:pending,approved,rejected',
        ];
    }

    public function messages(): array
    {
        return [
            'proposed_name.required' => 'Le nom de la proposition est obligatoire.',
            'proposed_name.string'   => 'Le nom de la proposition doit être une chaîne de caractères.',
            'proposed_name.max'      => 'Le nom de la proposition ne doit pas dépasser 255 caractères.',
            'description.string'     => 'La description doit être une chaîne de caractères.',
            'status.in'              => 'Le statut doit être "pending", "approved" ou "rejected".',
        ];
    }
}

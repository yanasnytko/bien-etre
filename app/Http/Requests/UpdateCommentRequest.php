<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Tu peux ajouter une logique pour vérifier que l'utilisateur modifie bien son propre commentaire.
        return true;
    }

    public function rules(): array
    {
        return [
            'title'      => 'required|string|max:150',
            'content'    => 'required|string',
            'date'       => 'required|date',
            'rating'     => 'nullable|integer|min:0|max:5',
            'is_abusive' => 'sometimes|boolean',
        ];
    }
}

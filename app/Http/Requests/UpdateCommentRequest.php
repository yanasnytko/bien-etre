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

    public function messages(): array
    {
        return [
            'title.required'      => 'Le titre du commentaire est obligatoire.',
            'title.string'        => 'Le titre doit être une chaîne de caractères.',
            'title.max'           => 'Le titre ne doit pas dépasser 150 caractères.',

            'content.required'    => 'Le contenu du commentaire est obligatoire.',
            'content.string'      => 'Le contenu doit être une chaîne de caractères.',

            'date.required'       => 'La date est obligatoire.',
            'date.date'           => 'La date doit être une date valide.',

            'rating.integer'      => 'La note doit être un entier.',
            'rating.min'          => 'La note ne peut être inférieure à 0.',
            'rating.max'          => 'La note ne peut être supérieure à 5.',

            'is_abusive.boolean'  => "Le statut 'abusive' doit être de type booléen.",
        ];
    }

}

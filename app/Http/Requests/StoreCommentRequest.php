<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // On autorise pour l'instant tout le monde.
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id'             => 'required|exists:users,id',
            'service_provider_id' => 'required|exists:service_providers,id',
            'title'               => 'required|string|max:150',
            'content'             => 'required|string',
            'date'                => 'required|date',
            'rating'              => 'nullable|integer|min:0|max:5',
            // En général, le champ is_abusive doit être false par défaut.
            'is_abusive'          => 'sometimes|boolean',
        ];
    }
}

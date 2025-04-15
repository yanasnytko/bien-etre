<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        // Pour l'instant, on autorise toutes les requêtes
        return true;
    }

    /**
     * Règles de validation pour stocker une promotion.
     */
    public function rules(): array
    {
        return [
            'service_provider_id' => 'required|exists:service_providers,id',
            'title'               => 'required|string|max:255',
            'description'         => 'nullable|string',
            'pdf'                 => 'nullable|file|mimes:pdf',  // Si tu prévois l'upload d'un fichier PDF
            'date_start'          => 'required|date',
            'date_end'            => 'required|date|after_or_equal:date_start',
            'display_start'       => 'required|date',
            'display_end'         => 'required|date|after_or_equal:display_start',
            'is_active'           => 'sometimes|boolean',
        ];
    }
}

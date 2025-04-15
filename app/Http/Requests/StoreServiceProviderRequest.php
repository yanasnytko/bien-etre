<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceProviderRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        // Tu peux implémenter ici la logique d'autorisation.
        // Pour l'instant, on retourne true pour autoriser tout le monde.
        return true;
    }

    /**
     * Définit les règles de validation pour la création d'un prestataire.
     */
    public function rules(): array
    {
        return [
            'company_name'   => 'required|string|max:150',
            'company_email'  => 'required|email|max:200',
            'telephone'      => 'required|string|max:15',
            'vat_number'     => 'required|string|max:15',
            'website'        => 'nullable|url|max:150',
            'description'    => 'nullable|string',
            // Ajoute ici d'autres règles de validation selon les besoins
        ];
    }
}

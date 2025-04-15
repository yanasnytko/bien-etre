<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceProviderRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Tu peux vérifier ici que l'utilisateur est propriétaire du prestataire, etc.
        return true;
    }

    public function rules(): array
    {
        return [
            'company_name'   => 'required|string|max:150',
            'company_email'  => 'required|email|max:200',
            'telephone'      => 'required|string|max:15',
            'vat_number'     => 'required|string|max:15',
            'website'        => 'nullable|url|max:150',
            'description'    => 'nullable|string',
            // Ajoute ici d'autres règles de validation si nécessaire
        ];
    }
}

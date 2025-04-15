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

    public function messages(): array
    {
        return [
            'company_name.required'  => "Le nom de l'entreprise est obligatoire.",
            'company_name.string'    => "Le nom de l'entreprise doit être une chaîne de caractères.",
            'company_name.max'       => "Le nom de l'entreprise ne doit pas dépasser 150 caractères.",

            'company_email.required' => "L'email de l'entreprise est obligatoire.",
            'company_email.email'    => "L'email de l'entreprise doit être une adresse valide.",
            'company_email.max'      => "L'email de l'entreprise ne doit pas dépasser 200 caractères.",

            'telephone.required'     => "Le téléphone est obligatoire.",
            'telephone.string'       => "Le téléphone doit être une chaîne de caractères.",
            'telephone.max'          => "Le téléphone ne doit pas dépasser 15 caractères.",

            'vat_number.required'    => "Le numéro de TVA est obligatoire.",
            'vat_number.string'      => "Le numéro de TVA doit être une chaîne de caractères.",
            'vat_number.max'         => "Le numéro de TVA ne doit pas dépasser 15 caractères.",

            'website.url'            => "Le site web doit être une URL valide.",
            'website.max'            => "Le site web ne doit pas dépasser 150 caractères.",

            'description.string'     => "La description doit être une chaîne de caractères.",
        ];
    }
}

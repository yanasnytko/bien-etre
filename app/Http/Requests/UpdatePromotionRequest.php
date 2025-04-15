<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // On part du principe que l'identifiant du prestataire ne se modifie pas
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'pdf'           => 'nullable|file|mimes:pdf',
            'date_start'    => 'required|date',
            'date_end'      => 'required|date|after_or_equal:date_start',
            'display_start' => 'required|date',
            'display_end'   => 'required|date|after_or_equal:display_start',
            'is_active'     => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'         => 'Le titre de la promotion est obligatoire.',
            'title.string'           => 'Le titre doit être une chaîne de caractères.',
            'title.max'              => 'Le titre ne doit pas dépasser 255 caractères.',

            'description.string'     => 'La description doit être une chaîne de caractères.',

            'pdf.file'               => 'Le document doit être un fichier.',
            'pdf.mimes'              => 'Le document doit être au format PDF uniquement.',

            'date_start.required'    => 'La date de début est obligatoire.',
            'date_start.date'        => 'La date de début doit être une date valide.',

            'date_end.required'      => 'La date de fin est obligatoire.',
            'date_end.date'          => 'La date de fin doit être une date valide.',
            'date_end.after_or_equal' => 'La date de fin doit être égale ou postérieure à la date de début.',

            'display_start.required' => "La date de début d'affichage est obligatoire.",
            'display_start.date'     => "La date de début d'affichage doit être une date valide.",

            'display_end.required'   => "La date de fin d'affichage est obligatoire.",
            'display_end.date'       => "La date de fin d'affichage doit être une date valide.",
            'display_end.after_or_equal' => "La date de fin d'affichage doit être égale ou postérieure à la date de début d'affichage.",

            'is_active.boolean'      => "Le statut actif doit être de type booléen.",
        ];
    }
}

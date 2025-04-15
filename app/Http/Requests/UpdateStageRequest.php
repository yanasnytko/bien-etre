<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'date_start'    => 'required|date',
            'date_end'      => 'required|date|after_or_equal:date_start',
            'display_start' => 'required|date',
            'display_end'   => 'required|date|after_or_equal:display_start',
            'cost'          => 'nullable|numeric',
            'currency'      => 'required|string|max:10',
            'image'         => 'nullable|string|max:255',
            'is_active'     => 'sometimes|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Le nom du stage est obligatoire.',
            'name.string'            => 'Le nom du stage doit être une chaîne de caractères.',
            'name.max'               => 'Le nom du stage ne peut pas dépasser 255 caractères.',
            
            'description.string'     => 'La description doit être une chaîne de caractères.',
            
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
            
            'cost.numeric'           => 'Le coût doit être un nombre valide.',
            
            'currency.required'      => 'La devise est obligatoire.',
            'currency.string'        => 'La devise doit être une chaîne de caractères.',
            'currency.max'           => 'La devise ne doit pas dépasser 10 caractères.',
            
            'image.string'           => "Le chemin de l'image doit être une chaîne de caractères.",
            'image.max'              => "Le chemin de l'image ne doit pas dépasser 255 caractères.",
            
            'is_active.boolean'      => "Le statut actif doit être un booléen.",
        ];
    }

}

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
}

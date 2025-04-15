<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_provider_id' => 'required|exists:service_providers,id',
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'date_start'          => 'required|date',
            'date_end'            => 'required|date|after_or_equal:date_start',
            'display_start'       => 'required|date',
            'display_end'         => 'required|date|after_or_equal:display_start',
            'cost'                => 'nullable|numeric',
            'currency'            => 'required|string|max:10',
            'image'               => 'nullable|string|max:255', // ou 'nullable|url' si c'est une URL
            'is_active'           => 'sometimes|boolean',
        ];
    }
}

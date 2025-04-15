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
}

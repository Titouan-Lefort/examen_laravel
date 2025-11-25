<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom_salle' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'adresse' => 'required|string|max:255',
        ];
    }
}

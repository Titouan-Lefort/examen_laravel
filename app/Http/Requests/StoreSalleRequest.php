<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSalleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Admin check is done via middleware usually
    }

    public function rules(): array
    {
        return [
            'nom_salle' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'adresse' => 'required|string|max:255',
            'date_spectacle' => 'required|date',
            'heure_spectacle' => 'required',
            'prix' => 'required|numeric|min:0',
        ];
    }
}

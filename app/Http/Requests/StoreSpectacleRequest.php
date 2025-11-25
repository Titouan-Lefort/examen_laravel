<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpectacleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'salle_id' => 'required|exists:salle,id',
            'date_spectacle' => 'required|date|after:today',
            'heure_spectacle' => 'required',
            'prix' => 'required|numeric|min:0',
        ];
    }
}

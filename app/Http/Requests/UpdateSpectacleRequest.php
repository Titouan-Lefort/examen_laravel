<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpectacleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'salle_id' => 'required|exists:salle,id',
            'date_spectacle' => 'required|date',
            'heure_spectacle' => 'required',
            'prix' => 'required|numeric|min:0',
        ];
    }
}

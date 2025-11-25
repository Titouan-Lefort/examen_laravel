<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'spectacle_id' => 'required|exists:spectacles,id',
            'nombre_personnes' => 'required|integer|min:1',
        ];
    }
}

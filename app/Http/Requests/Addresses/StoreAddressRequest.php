<?php

namespace App\Http\Requests\Addresses;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'delivery_zone_id' => 'required|integer|exists:delivery_zones,id',
            'street' => 'required|string|max:255',
            'building_number' => 'required|string|max:50',
            'phone_number' => 'required|string|max:20',
            'label' => 'nullable|string|max:100',
            'floor' => 'nullable|string|max:50',
            'apartment' => 'nullable|string|max:50',
            'landmark' => 'nullable|string|max:255',
            'is_default' => 'nullable|boolean',
        ];
    }
}

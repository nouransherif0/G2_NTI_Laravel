<?php

namespace App\Http\Requests\Carts;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'add_ons' => 'nullable|array',
            'add_ons.*.id' => 'required|string|exists:add_ons,id',
            'add_ons.*.price_adjustment' => 'required|numeric|min:0',
            'add_ons.*.name' => 'required|string',
        ];
    }
}

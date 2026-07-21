<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address_id' => [
                'required',
                'string',
                Rule::exists('addresses', 'id')->where(function ($query) {
                    $query->where('user_id', $this->user()->id);
                }),
            ],
            'payment_method' => ['required', 'string', 'in:cash,card'],
        ];
    }
    
    public function messages(): array
    {
        return [
            'address_id.required' => 'Please select a delivery address.',
            'address_id.exists' => 'The selected address is invalid or does not belong to you.',
            'payment_method.in' => 'The selected payment method is invalid.',
        ];
    }
}

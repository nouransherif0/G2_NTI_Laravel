<?php

namespace App\Http\Requests\AddOns;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddOnRequest extends FormRequest
{
    public function authorize(): bool
    {
   return true;
    }

    public function rules(): array
    {
   return [
    'name' => 'sometimes|required|string|max:255',
    'price_adjustment' => 'sometimes|required|numeric|min:0',
   ];
    }
  public function message(): array{
    return[
      'name.max' => 'The name can not be longer than 100 characters!',
      'name.string' => 'The name must be a string!',
      'name.required' => 'The name must not be empty!',
      'price_adjustment.min' => 'The price_adjustment can not hold -ve value!',
      'price_adjustment.numeric' => 'The nprice_adjustmentame must be a number!',
      'price_adjustment.required' => 'The price_adjustment must not be empty!',

    ];
   } 
}
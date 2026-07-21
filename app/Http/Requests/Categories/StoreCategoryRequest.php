<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'image' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.numeric' => 'Name must be a number.',
            'name.integer' => 'Name must be an integer.',
            'name.exists' => 'The selected Name is invalid.',
            'name.boolean' => 'Name must be true or false.',
            'name.array' => 'Name must be an array.',
            'name.email' => 'Name must be a valid email address.',
            'name.max' => 'Name exceeds the maximum allowed length.',
            'name.min' => 'Name is below the minimum allowed length.',
            'image.required' => 'Image is required.',
            'image.string' => 'Image must be a string.',
            'image.numeric' => 'Image must be a number.',
            'image.integer' => 'Image must be an integer.',
            'image.exists' => 'The selected Image is invalid.',
            'image.boolean' => 'Image must be true or false.',
            'image.array' => 'Image must be an array.',
            'image.email' => 'Image must be a valid email address.',
            'image.max' => 'Image exceeds the maximum allowed length.',
            'image.min' => 'Image is below the minimum allowed length.',
        ];
    }
}

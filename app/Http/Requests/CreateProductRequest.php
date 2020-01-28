<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:categories',
            'description' => 'string|nullable',
            'category_id' => 'nullable|integer',
            'unit_id' => 'nullable|integer',
            'price' => 'required|between:0,99.99',
            'image' => 'nullable|array|required_with:alt',
            'image.*' => 'max:10240',
            'alt' => 'nullable|string',
        ];
    }
}

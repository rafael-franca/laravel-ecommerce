<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:products|max:255',
            'image' => 'required_if:published,true|url',
            'barcode' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required_if:published,true|string',
            'published' => 'boolean'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'The product name is required',
            'name.max' => 'The product name is too large',
            'slug.required'  => 'The product slug is required',
            'slug.unique' => 'The slug has exists',
            'slug.max' => 'The slug is too large',
            'image.required_if' => 'The image is required',
            'image.url' => 'The image must be a URL',
            'barcode.required' => 'The barcode is required',
            'barcode.numeric' => 'The barcode must be numeric',
            'price.required' => 'The price is required',
            'price.numeric' => 'The price must be numeric',
            'description.required_if' => 'The description is required',
        ];
    }
}

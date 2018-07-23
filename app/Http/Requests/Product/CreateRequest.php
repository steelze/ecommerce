<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            "name" => "required|unique:products",
            "category" => "required",
            "price" => "required",
            "image.*" => "mimes:jpeg,jpg,png|max:1999"
        ];
    }

    public function messages()
    {
        return [
            "image.*.mimes" => "Image(s) must be of type jpeg, jpg, png"
        ];
    }
}

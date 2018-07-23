<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            "shipping_name" => "required",
            "shipping_email" => "required|email",
            "shipping_address" => "required",
            "shipping_state" => "required",
            "shipping_phone_number" => "required"
        ];
    }

    public function messages()
    {
        return [
            "shipping_name.required" => "Name is required",
            "shipping_email.required" => "Email is required",
            "shipping_email.email" => "Invalid Email",
            "shipping_address.required" => "Address is required",
            "shipping_state.required" => "State is required",
            "shipping_phone_number.required" => "Phone Digits is required"
        ];
    }
}

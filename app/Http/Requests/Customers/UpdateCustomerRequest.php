<?php

namespace App\Http\Requests\Customers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    const REQUIRED_STRING = "required|string|max:255";
    const REQUIRED_BOOLEAN = "required|boolean";
    
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
            "name"      => self::REQUIRED_STRING,
            "gender"    => self::REQUIRED_BOOLEAN,
            "phone"     => self::REQUIRED_STRING,
            "address"   => self::REQUIRED_STRING,
        ];
    }
}

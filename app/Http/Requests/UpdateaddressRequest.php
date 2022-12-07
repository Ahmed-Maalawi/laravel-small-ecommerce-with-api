<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateaddressRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address_type' => 'string | min:3 | required',
            'phone_number' => 'string | nullable | required',
            'address_description' => 'string | required',
        ];
    }


   public function failedValidation(Validator $validator)
   {
       return response()->json([
           'status' => 'error',
           'message' => 'validation error',
           'errors' => $validator->errors(),
       ]);
   }
}

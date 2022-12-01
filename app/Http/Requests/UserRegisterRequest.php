<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required | string | min:3',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:6 | confirmed',
            'phone' => 'string | required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException( response()->json([
           'status' => 'error',
           'message' => 'validation error',
           'errors' => $validator->errors(),
       ], 400));
    }
}

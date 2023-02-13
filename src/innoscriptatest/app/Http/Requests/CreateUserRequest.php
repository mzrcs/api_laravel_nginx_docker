<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponseHandler;
use App\Helpers\Language;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateUserRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|confirmed|between:6,255'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter valid email.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Confirmed password and password does not match.',
        ];
    }
    
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(ApiResponseHandler::validationError($validator->errors(), Language::getMessage('general.validation'))); 
    }
}

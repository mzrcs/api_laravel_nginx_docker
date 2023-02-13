<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponseHandler;
use App\Helpers\Language;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginUserRequest extends FormRequest
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
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter valid email.',
            'password.required' => 'Password is required.',
        ];
    }
    
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(ApiResponseHandler::validationError($validator->errors(), Language::getMessage('general.validation'))); 
    }
}

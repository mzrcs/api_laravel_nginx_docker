<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponseHandler;
use App\Helpers\Language;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'password' => 'required',
            'preferred_news_feeds' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'preferred_news_feeds.required' => 'Preferred new feed can not be empty.',
            'password.required' => 'Password is required.',
        ];
    }
    
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(ApiResponseHandler::validationError($validator->errors(), Language::getMessage('general.validation'))); 
    }
}

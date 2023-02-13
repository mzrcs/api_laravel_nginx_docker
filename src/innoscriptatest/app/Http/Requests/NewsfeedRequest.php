<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponseHandler;
use App\Helpers\Language;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewsfeedRequest extends FormRequest
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
            'q' => 'required',
            'from' => [
                'required',
                'date_format:Y-m-d',
            ],
            'to' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:from'
            ],
            'category' => 'required_without:sources|prohibits:sources',
            'sources' => 'required_without:category|prohibits:category',
        ];
    }

    // public function messages()
    // {
    //     return [
    //     ];
    // }
    
    protected function failedValidation(Validator $validator) { 
        throw new HttpResponseException(ApiResponseHandler::validationError($validator->errors(), Language::getMessage('general.validation'))); 
    }
}

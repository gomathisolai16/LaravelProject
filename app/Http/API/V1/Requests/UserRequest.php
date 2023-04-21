<?php

namespace App\Http\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRequest
 * @package App\Http\API\V1\Requests
 */
class UserRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|max:190',
            'last_name' => 'required|max:190',
            'email' => 'required|email|max:190',
            'username' => 'required|unique:users|max:190'
        ];

        if ($this->method() == 'POST') {
            $rules['password'] = 'required|min:6|max:190';
        }

        return $rules;
    }
}

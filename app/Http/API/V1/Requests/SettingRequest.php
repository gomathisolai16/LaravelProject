<?php

namespace App\Http\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SettingRequest
 * @package App\Http\API\V1\Requests
 */
class SettingRequest extends FormRequest
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

        ];
    }
}

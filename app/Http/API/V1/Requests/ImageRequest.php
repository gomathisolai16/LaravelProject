<?php

namespace App\Http\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ImageRequest
 * @package App\Http\API\V1\Requests
 */
class ImageRequest extends FormRequest
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
            'base64'=>'required',
            'title'=>'required|max:255'
        ];
    }
}

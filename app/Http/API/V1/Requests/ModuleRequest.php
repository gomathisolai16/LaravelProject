<?php

namespace App\Http\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ModuleRequest
 * @package App\Http\API\V1\Requests
 */
class ModuleRequest extends FormRequest
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
            'name'=>'required|max:160',
            'abbreviation' =>'max:60',
            'public' => 'boolean',
            'active' => 'boolean'
        ];
    }
}

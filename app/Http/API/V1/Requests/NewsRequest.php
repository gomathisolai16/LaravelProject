<?php

namespace App\Http\API\V1\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class DashboardRequest
 * @package App\Http\API\V1\Requests
 */
class NewsRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required|min:20',
            'meta_keywords' => 'array',
            'percentage' => 'required',
            'parked' => 'boolean',
            'top' =>'boolean',
            'categories' =>'array',
            'tickers' =>'array',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'frigana' => [
                'required',
                'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'
            ],
            'company_name' => 'required',
            'business_description' => 'required',
            'prefecture_id' => 'required|array',
            'prefecture_id.*' => 'integer|between:1,47',
            'number_of_employees' => 'required|integer',
            'company_url' => 'required|url',
        ];
    }
}

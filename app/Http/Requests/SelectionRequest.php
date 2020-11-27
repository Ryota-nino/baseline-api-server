<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelectionRequest extends FormRequest
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
            'company_id' => 'required|integer',
            'internship_id' => 'required|integer',
            'occupational_category_id' => 'required|integer',
            'items' => 'required',
            'items.*.title' => 'required',
            'items.*.content' => 'required',
            'items.*.interview_date' => 'required|date',
        ];
    }
}

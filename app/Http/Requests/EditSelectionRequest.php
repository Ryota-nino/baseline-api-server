<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditSelectionRequest extends FormRequest
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
            'internship_id' => 'required|integer|exists:internships,id',
            'occupational_category_id' => 'required|integer|exists:occupational_categories,id',
            'items' => 'required',
            'items.*.title' => 'required',
            'items.*.content' => 'string|nullable',
            'items.*.interview_date' => 'required|date',
        ];
    }
}

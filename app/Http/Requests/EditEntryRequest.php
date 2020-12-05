<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEntryRequest extends FormRequest
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
            'internship_id' => 'required|integer',
            'occupational_category_id' => 'required|integer',
            'items' => 'required',
            'items.*.title' => 'required',
            'items.*.content' => 'required',
        ];
    }
}

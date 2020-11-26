<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
//            'student_number' => 'required|integer|digits:7',
//            'first_name' => 'required|string',
//            'last_name' => 'required|string',
//            'sex' => 'required|integer|between:0,2', // 0:男, 1:女, 2:その他
//            'annual' => 'required|integer|min:1',
//            'year_of_graduation' => 'required|date',
//            'desired_occupations' => 'required|exists:occupational_categories,id',
            'email' => 'required|email',
//            'password' => 'required'
        ];
    }
}

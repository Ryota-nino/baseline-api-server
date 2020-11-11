<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class RegistCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //validate
        $request->validate([
            'frigana' => [
                'required',
                'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'
            ],
            'company_name' => 'required',
            'business_description' => 'required',
            'prefecture_id' => 'required|array',
            'prefecture_id.*' => 'integer|between:1,47',
            'number_of_employees' => 'required|integer',
            'logo_path' => 'required',
            'company_url' => 'required|url',
        ]);

        $company = new Company();
        $status = 200;
        $message = 'OK';

        if(!$company->fill($request->all())->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        //都道府県と紐付け
        $company->prefectures()->attach($request->prefecture_id);
            
        return response()->json([
            'message' => $message
        ], $status);
    }
}

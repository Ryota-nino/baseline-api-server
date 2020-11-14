<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
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
    public function __invoke(CompanyRequest $request)
    {
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

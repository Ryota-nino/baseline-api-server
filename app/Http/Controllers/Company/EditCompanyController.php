<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class EditCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CompanyRequest $request)
    {
        $status = 200;
        $message = 'OK';

        $param = [
            'id' => $request->id,
            'frigana' => $request->frigana,
            'company_name' => $request->company_name,
            'business_description' => $request->business_description,
            'number_of_employees' => $request->number_of_employees,
            'logo_path' => $request->logo_path,
            'company_url' => $request->company_url,
        ];

        //$company = Company::where('id',$request->id)
            //->update($param);

        if(!Company::where('id',$request->id)->update($param)){
            $status = 400;
            $message = 'Bad Request';
        }

        //$company->prefectures()->attach($request->prefecture_id);

        return response()->json([
            'message' => $message,
        ], $status);
    }
}

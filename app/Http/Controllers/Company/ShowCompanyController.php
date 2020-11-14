<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        //ToDo Validate

        $status = 200;
        $message = 'OK';

        if(!Company::select($id)) {
            $status = 400;
            $message = 'Bad Request';
        }

        $company_data = DB::table('companies')
                            ->join('company_prefectures', 'companies.id', '=', 'company_prefectures.company_id')
                            ->select('id','frigana','company_name','business_description','number_of_employees',
                                'logo_path','company_url','company_id','prefecture_id')
                            ->where('companies.id', '=', $id)
                            ->get();

        return response()->json([
            'message' => $message,
            'data' => $company_data
        ], $status);
    }
}

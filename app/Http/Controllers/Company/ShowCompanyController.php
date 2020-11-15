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

        $company = Company::findOrfail($id);

        $company_data = [
            "id" => $company->id,
            "frigana" => $company->frigana,
            "company_name" => $company->company_name,
            "business_description" => $company->business_description,
            "number_of_employees" => $company->number_of_employees,
            "logo_path" => $company->logo_path,
            "company_url" => $company->company_url,
            "created_at" => $company->created_at,
            "updated_at" => $company->updated_at,
            "prefectures" => array_column($company->prefectures->toArray(), 'id'),
        ];

        return response()->json(
            $company_data, $status
        );
    }
}

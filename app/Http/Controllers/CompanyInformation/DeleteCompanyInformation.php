<?php

namespace App\Http\Controllers\CompanyInformation;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;

class DeleteCompanyInformation extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function __invoke(CompanyInformation $companyInformation)
    {
        $companyInformation->delete();

        return response()->json(
            ["message" => "OK"]
        );
    }
}

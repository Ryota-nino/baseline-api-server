<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;

class ShowCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id)
    {
        //ToDo Validate

        $status = 200;

        $company = Company::with('prefectures:id')->findOrfail($id);

        return response()->json(
            $company, $status
        );
    }
}

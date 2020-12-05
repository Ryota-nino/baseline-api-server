<?php

namespace App\Http\Controllers\CompanyInformation;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use Illuminate\Http\Request;

class DeleteCompanyInformation extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function __invoke($id, Request $request)
    {
        CompanyInformation::query()->findOrFail($id)->delete();

        return response()->json("OK");
    }
}

<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;

class DeleteCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id)
    {
        $status = 200;
        $message = 'OK';


        Company::findOrFail($id)->delete();

        return response()->json([
            'message' => $message
        ], $status);
    }
}

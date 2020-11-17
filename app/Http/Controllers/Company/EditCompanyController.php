<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class EditCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id, CompanyRequest $request)
    {
        $status = 200;
        $message = 'OK';

        //TODO 画像データの処理

        $company = Company::findOrfail($id);

        $company->prefectures()->detach();
        $company->prefectures()->attach($request->prefecture_id);

        $company->fill($request->all())->update();

        return response()->json([
            'message' => $message,
            'data' => $company
        ], $status);
    }
}

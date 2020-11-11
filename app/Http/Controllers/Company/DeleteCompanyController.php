<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class DeleteCompanyController extends Controller
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

        //Company::destroy($request->id);
        if(!Company::find($id)->delete()) {
            $status = 400;
            $message = 'Bad Request';
        }

        //$company->prefectures()->attach($request->prefecture_id);

        return response()->json([
            'message' => $message
        ], $status);
    }
}

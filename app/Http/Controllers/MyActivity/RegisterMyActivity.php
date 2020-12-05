<?php

namespace App\Http\Controllers\MyActivity;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyActivityRequest;
use App\Models\CompanyInformation;
use App\Models\MyActivity;
use Auth;

class RegisterMyActivity extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param MyActivityRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(MyActivityRequest $request)
    {
        $user = Auth::user();
        $company_info = new CompanyInformation();
        $my_activity = new MyActivity();
        $status = 200;
        $message = "OK";

        if (!$company_info->fill(["user_id" => $user->id])->save()) {
            $status = 400;
            $message = "Bad Request";
        }

        if (!$my_activity->fill($request->all())->fill(["posted_year" => $user->annual])) {
            $status = 400;
            $message = "Bad Request";
        }

        if (!$company_info->my_activities()->save($my_activity)) {
            $status = 400;
            $message = "Bad Request";
        }


        return response()->json([
            $message
        ], $status);
    }
}

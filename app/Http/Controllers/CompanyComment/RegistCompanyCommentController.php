<?php

namespace App\Http\Controllers\CompanyComment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCommentRequest;
use App\Models\CompanyInformation;
use App\Models\CompanyComment;
use Illuminate\Support\Facades\Auth;

class RegistCompanyCommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CompanyCommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(CompanyCommentRequest $request)
    {
        $user = Auth::user();
        $company_info = new CompanyInformation();
        $compny_comment = new CompanyComment();
        $status = 200;
        $message = "OK";

        if (!$company_info->fill(["user_id" => $user->id])->save()) {
            $status = 400;
            $message = "Bad Request";
        }

        if (!$compny_comment->fill($request->all())) {
            $status = 400;
            $message = "Bad Request";
        }

        if (!$company_info->my_activities()->save($compny_comment)) {
            $status = 400;
            $message = "Bad Request";
        }


        return response()->json(
            $message, $status);
    }
}

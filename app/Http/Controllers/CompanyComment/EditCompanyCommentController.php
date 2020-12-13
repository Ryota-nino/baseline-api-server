<?php

namespace App\Http\Controllers\CompanyComment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyCommentRequest;
use App\Models\CompanyInformation;

class EditCompanyCommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CompanyInformation $companyInformation, CompanyCommentRequest $request)
    {
        $company_comment = $companyInformation
            ->company_comments->first();

        // CompanyCommentが存在しないとき404を返却
        if (!$company_comment) {
            abort(404);
        }

        $company_comment->fill($request->all())->update();

        return response()->json(
            ["message" => "OK"]
        );
    }
}

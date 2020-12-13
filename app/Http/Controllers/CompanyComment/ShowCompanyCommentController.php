<?php

namespace App\Http\Controllers\CompanyComment;

use App\Http\Controllers\Controller;
use App\Models\CompanyComment;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\Auth;

class ShowCompanyCommentController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CompanyInformation $companyInformation)
    {
        //$user = Auth::user();
        $status = 200;
        $company_comment = $companyInformation->load('company_comments');

        if ($company_comment->company_comments->count() == 0) {
            abort(404);
        }

        return response()->json(
            $company_comment, $status
        );
    }
}

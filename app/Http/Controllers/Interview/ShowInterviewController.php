<?php

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;

class ShowInterviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CompanyInformation $companyInformation)
    {
        $status = 200;
        $interview = $companyInformation->load('interviews.interview_contents');

        if ($interview->interviews->count() == 0) {
            abort(404);
        }

        return response()->json(
            $interview, $status
        );
    }
}

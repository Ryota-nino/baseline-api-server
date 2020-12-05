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
    public function __invoke($id)
    {
        $status = 200;
        $interview = CompanyInformation::query()->with('interviews.interview_contents')->findOrFail($id);

        if($interview->interviews->count() == 0){
            abort(404);
        }

        return response()->json(
            $interview, $status
        );
    }
}

<?php

namespace App\Http\Controllers\Interview;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\InterviewRequest;
use App\Models\CompanyInformation;
use App\Models\Interview;
use App\Models\InterviewContent;
use Faker\Provider\ar_JO\Internet;
use Illuminate\Http\Request;

class RegistInterviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(InterviewRequest $request)
    {
        $step = 1;
        $user = Auth::user();
        $company_info = new CompanyInformation();
        $status = 200;
        $message1 = 'Company_Information table is OK';
        $message2 = 'Interview table is OK';

        $company_info->user_id = $user->id;
        if (!$company_info->fill($request->all())->save()) {
            $status = 400;
            $message1 = 'Company_Information table is Bad Request';
        }
        
        foreach($request->items as $item){
            $interview = new Interview();
            $interview->fill($item);
            $interview->company_information_id = $company_info->id;
            $interview->step = $step;

            if(!$interview->save()){
                $status = 400;
                $message2 = 'Interview table is Bad Request';
            }

            foreach ($item['contents'] as $content) {
                $interview_content = new InterviewContent();
                $interview_content->content = $content;
                $interview_content->interview_id = $interview->id;

                if (!$interview_content->save()) {
                    $status = 400;
                    $message2 = 'InterviewContents table is Bad Request';
                }
            }
            $step++;
        }

         return response()->json([
             'message' => [
                $message1,
                $message2
            ]
        ], $status, );
    }
}

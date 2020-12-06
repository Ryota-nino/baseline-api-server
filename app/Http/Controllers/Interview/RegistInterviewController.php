<?php

namespace App\Http\Controllers\Interview;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\InterviewRequest;
use App\Models\CompanyInformation;
use App\Models\Interview;
use App\Models\InterviewContent;
use Illuminate\Support\Facades\DB;

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

        try{
            DB::beginTransaction();
            $company_info->user_id = $user->id;
            $company_info->fill($request->all())->save();

            //interviews表にデータを登録
            foreach ($request->items as $item) {
                $interview = new Interview();
                $interview->fill($item);
                $interview->company_information_id = $company_info->id;
                $interview->step = $step;
                $interview->save();

                //interview_contents表にデータを登録
                foreach ($item['contents'] as $content) {
                    $interview_content = new InterviewContent();
                    $interview_content->content = $content;
                    $interview_content->interview_id = $interview->id;
                    $interview_content->save();
                }
                $step++;
            } 
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $status = 400;
            return response()->json([
                'message' => 'Failed to request'
            ], $status,);
        }
        return response()->json([
            'message' => 'OK'
        ], $status,);
    }
}

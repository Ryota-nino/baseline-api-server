<?php

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditInterviewRequest;
use App\Models\CompanyInformation;
use App\Models\Interview;
use App\Models\InterviewContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditInterviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CompanyInformation $companyInformation
     * @param EditInterviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CompanyInformation $companyInformation, EditInterviewRequest $request)
    {
        $company_info = $companyInformation->load('interviews');
        $company_info_id = $companyInformation->id;
        if ($company_info->interviews->count() == 0) {
            abort(404);
        }
        $step = 1;
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;

        try {
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Interview::query()->where('company_information_id', $company_info_id)->delete();

            //interviewsテーブルを更新
            foreach ($request->items as $item) {
                $interview = new Interview();
                $interview->fill($item);
                $interview->company_information_id = $company_info_id;
                $interview->step = $step;
                $interview->save();

                //interviews_contentsテーブルを更新
                foreach($item['contents'] as $content){
                    $interview_content = new InterviewContent();
                    $interview_content->content = $content;
                    $interview_content->interview_id = $interview->id;
                    $interview_content->save();
                }
                $step++;
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            $status = 400;
            return response()->json([
                'message' => $e
            ], $status,);
        }
        return response()->json([
            'message' => 'OK'
        ], $status,);
    }

}

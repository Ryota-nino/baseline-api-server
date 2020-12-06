<?php

namespace App\Http\Controllers\Interview;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use App\Models\Interview;
use App\Models\InterviewContent;
use App\Http\Requests\EditInterviewRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EditInterviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, EditInterviewRequest $request)
    {
        $company_info = CompanyInformation::with('interviews')->findOrFail($id);
        if($company_info->interviews->count() == 0){
            abort(404);
        }
        $step = 1;
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;
        
        try{
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Interview::query()->where('company_information_id', $id)->delete();
 
            //interviewsテーブルを更新
            foreach($request->items as $item){
                $interview = new Interview();
                $interview->fill($item);
                $interview->company_information_id = $id;
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

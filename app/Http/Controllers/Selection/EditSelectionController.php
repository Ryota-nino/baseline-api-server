<?php

namespace App\Http\Controllers\Selection;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditSelectionRequest;
use App\Models\Selection;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\DB;

class EditSelectionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, EditSelectionRequest $request)
    {
        $company_info = CompanyInformation::with('selections')->findOrFail($id);
        //selectionsテーブルと紐付けされていない企業idの場合は処理しない
        if($company_info->selections->count() == 0){
            abort(404);
        }
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;
        
        try{
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Selection::query()->where('company_information_id', $id)->delete();

            //selectionsテーブルを更新
            foreach($request->items as $item){
                $selection = new Selection();
                $selection->fill($item);
                $selection->company_information_id = $id;
                $selection->save();
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
            'message' => 'OK',
        ], $status);
    }
}

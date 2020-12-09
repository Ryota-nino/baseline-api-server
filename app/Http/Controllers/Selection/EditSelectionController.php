<?php

namespace App\Http\Controllers\Selection;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditSelectionRequest;
use App\Models\CompanyInformation;
use App\Models\Selection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditSelectionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(CompanyInformation $companyInformation, EditSelectionRequest $request)
    {
        $company_info = $companyInformation->load('selections');
        //selectionsテーブルと紐付けされていない企業idの場合は処理しない
        if ($company_info->selections->count() == 0) {
            abort(404);
        }
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;

        try{
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Selection::query()->where('company_information_id', $companyInformation->id)->delete();

            //selectionsテーブルを更新
            foreach($request->items as $item){
                $selection = new Selection();
                $selection->fill($item);
                $selection->company_information_id = $companyInformation->id;
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

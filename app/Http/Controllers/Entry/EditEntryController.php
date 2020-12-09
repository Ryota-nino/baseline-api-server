<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditEntryRequest;
use App\Models\CompanyInformation;
use App\Models\Entry;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CompanyInformation $companyInformation
     * @param EditEntryRequest $request
     * @return JsonResponse
     */
    public function __invoke(CompanyInformation $companyInformation, EditEntryRequest $request)
    {
        $company_info = $companyInformation->load('entries');
        ////entriesテーブルと紐付けされていない企業idの場合は処理しない
        if ($company_info->entries->count() == 0) {
            abort(404);
        }
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;

        try{
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Entry::query()->where('company_information_id', $companyInformation->id)->delete();

            //entriesテーブルにデータを更新
            foreach($request->items as $item){
                $entry = new Entry();
                $entry->fill($item);
                $entry->company_information_id = $companyInformation->id;
                $entry->save();
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            $status = 400;
            return response()->json([
                'message' => $e,
            ], $status);
        }
        return response()->json([
            'message' => 'OK',
        ], $status);
    }
}

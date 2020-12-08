<?php

namespace App\Http\Controllers\Entry;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditEntryRequest;
use App\Models\Entry;
use App\Models\CompanyInformation;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EditEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, EditEntryRequest $request)
    {
        $company_info = CompanyInformation::with('entries')->findOrFail($id);
        ////entriesテーブルと紐付けされていない企業idの場合は処理しない
        if($company_info->entries->count() == 0){
            abort(404);
        }
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;
        
        try{
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Entry::query()->where('company_information_id', $id)->delete();

            //entriesテーブルにデータを更新
            foreach($request->items as $item){
                $entry = new Entry();
                $entry->fill($item);
                $entry->company_information_id = $id;
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

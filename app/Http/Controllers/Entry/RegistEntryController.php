<?php

namespace App\Http\Controllers\Entry;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\EntryRequest;
use App\Models\CompanyInformation;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;

class RegistEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EntryRequest $request)
    {
        $user = Auth::user();
        $company_info = new CompanyInformation();
        $status = 200;

        try{
            DB::beginTransaction();
            $company_info->user_id = $user->id;
            $company_info->fill($request->all())->save();

            //entriesテーブルにデータを登録
            foreach ($request->items as $item) {
                $entry = new Entry();
                $entry->fill($item);
                $entry->company_information_id = $company_info->id;
                $entry->save();
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            $status = 400;
            return response()->json([
                'message' => $e
            ], $status,);
        }
        return response()->json([
            'message' => 'OK'
        ], $status, );
    }
}

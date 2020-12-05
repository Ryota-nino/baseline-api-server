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
        $company_info = CompanyInformation::query()->findOrFail($id);
        $entry = CompanyInformation::with('entries')->findOrFail($id);
        if($entry->entries->count() == 0){
            abort(404);
        }
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;
        
        try{
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Entry::query()->where('company_information_id', $id)->delete();

            foreach($request->items as $item){
                $entry = new Entry();
                $entry->fill($item);
                $entry->company_information_id = $id;
                $entry->save();
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
        }

        return response()->json([
            'message' => 'OK',
        ], $status);
    }
}

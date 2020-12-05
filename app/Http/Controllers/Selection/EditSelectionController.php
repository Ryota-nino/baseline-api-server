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
        $company_info = CompanyInformation::query()->findOrFail($id);
        $selection = CompanyInformation::with('selections')->findOrFail($id);
        if($selection->selections->count() == 0){
            abort(404);
        }
        $user = Auth::user();
        $status = 200;
        $company_info->user_id = $user->id;
        
        try{
            DB::beginTransaction();
            $company_info->fill($request->all())->update();
            Selection::query()->where('company_information_id', $id)->delete();

            foreach($request->items as $item){
                $selection = new Selection();
                $selection->fill($item);
                $selection->company_information_id = $id;
                $selection->save();
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

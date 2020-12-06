<?php

namespace App\Http\Controllers\Selection;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelectionRequest;
use App\Models\CompanyInformation;
use App\Models\Selection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistSelectionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(SelectionRequest $request)
    {
        $user = Auth::user();
        $company_info = new CompanyInformation();
        $status = 200;

        try{
            DB::beginTransaction();
            $company_info->user_id = $user->id;
            $company_info->fill($request->all())->save();

            foreach($request->items as $item){
                $selection = new Selection();
                $selection->fill($item);
                $selection->company_information_id = $company_info->id;
                $selection->save();
            }
            DB::commit();
            return response()->json([
                'message' => 'OK'
            ], $status,);
        }catch(\Exception $e){
            DB::rollBack();
            $status = 400;
            return response()->json([
                'message' => $e
            ], $status,);
        }
    }
}

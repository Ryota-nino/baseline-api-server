<?php

namespace App\Http\Controllers\Selection;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelectionRequest;
use App\Models\CompanyInformation;
use App\Models\Selection;
use Illuminate\Http\Request;



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
        $step = 1;
        $user = Auth::user();
        $company_info = new CompanyInformation();
        $status = 200;
        $message1 = 'Company_Information table is OK';
        $message2 = 'Selection table is OK';

        $company_info->user_id = $user->id;
        if (!$company_info->fill($request->all())->save()) {
            $status = 400;
            $message1 = 'Company_Information table is Bad Request';
        }

        foreach($request->items as $item){
            $selection = new Selection();
            $selection->fill($item);
            $selection->company_information_id = $company_info->id;
            //$selection->step = $step;
            //$step+=1;
            if(!$selection->save()){
                $status = 400;
                $message2 = 'Selection table is Bad Request';
            }
        }

         return response()->json([
             'message' => [
                $message1,
                $message2
            ]
        ], $status, );
    }
}

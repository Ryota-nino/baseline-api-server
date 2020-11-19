<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryRequest;
use App\Models\CompanyInformation;
use App\Models\Entry;

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
        $company_info = new CompanyInformation();
        $status = 200;
        $message1 = 'Company_Information table is OK';
        $message2 = 'Entry table is OK';

        if (!$company_info->fill($request->all())->save()) {
            $status = 400;
            $message1 = 'Company_Information table is Bad Request';
        }

        foreach($request->items as $item){
            $entry = new Entry();
            $entry->fill($item);
            $entry->company_information_id = $company_info->id;
            
            if(!$entry->save()){
                $status = 400;
                $message2 = 'Entry table is Bad Request';
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

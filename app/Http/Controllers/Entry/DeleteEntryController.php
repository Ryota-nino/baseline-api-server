<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use App\Models\Entry;

class DeleteEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $status = 200;
        $message = 'OK';

        CompanyInformation::findOrfail($id)->delete();

        return response()->json([
            'message' => $message
        ], $status);
    }
}

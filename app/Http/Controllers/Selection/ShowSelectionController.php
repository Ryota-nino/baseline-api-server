<?php

namespace App\Http\Controllers\Selection;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;

class ShowSelectionController extends Controller
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
        $entry = CompanyInformation::with('selections')->findOrFail($id);

        if($entry->selections->count() == 0){
            abort(404);
        }

        return response()->json(
            $entry, $status
        );
    }
}

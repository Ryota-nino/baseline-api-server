<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entry;

class ShowEntryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        //ToDo validate

        $status = 200;

        $entry = Entry::where('company_information_id',$id)->get();

        return response()->json(
            $entry, $status
        );
    }
}

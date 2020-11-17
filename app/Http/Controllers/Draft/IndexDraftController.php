<?php

namespace App\Http\Controllers\Draft;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use Illuminate\Http\Request;

class IndexDraftController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $draft = Draft::where('posted_by',$request->posted_by)->get();

        return response()->json(
            $draft
        );
    }
}


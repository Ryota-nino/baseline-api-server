<?php

namespace App\Http\Controllers\Draft;

use App\Http\Controllers\Controller;
use App\Models\Draft;

class DeleteDraftController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Draft $draft)
    {
        $draft->delete();

        return response()->json(["message" => "OK"]);
    }
}

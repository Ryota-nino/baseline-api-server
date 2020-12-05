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
    public function __invoke($id)
    {
        $status = 200;
        $message = 'OK';

        Draft::query()->findOrFail($id)->delete();

        return response()->json([
            'message' => $message
        ], $status);
    }
}

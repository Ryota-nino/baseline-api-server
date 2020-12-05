<?php

namespace App\Http\Controllers\MyActivity;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use Illuminate\Http\Request;

class ShowMyActivity extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id, Request $request)
    {
        $my_activities = CompanyInformation::with('my_activities')->findOrFail($id);

        if ($my_activities->my_activities->count() == 0) {
            abort(404);
        }

        return response()->json(
            $my_activities
        );
    }
}

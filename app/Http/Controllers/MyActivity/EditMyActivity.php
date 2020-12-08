<?php

namespace App\Http\Controllers\MyActivity;

use App\Http\Controllers\Controller;
use App\Http\Requests\MyActivityRequest;
use App\Models\CompanyInformation;

class EditMyActivity extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id, MyActivityRequest $request)
    {
        $my_activity = CompanyInformation::query()
            ->FindOrFail($id)
            ->my_activities->first();

        // MyActivityが存在しないとき404を返却
        if (!$my_activity) {
            abort(404);
        }

        $my_activity->fill($request->all())->update();

        return response()->json(
            ["message" => "OK"]
        );
    }
}

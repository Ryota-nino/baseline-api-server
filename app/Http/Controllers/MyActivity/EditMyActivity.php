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
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, MyActivityRequest $request)
    {
        $my_activities = CompanyInformation::query()
            ->FindOrFail($id)
            ->first()
            ->my_activities
            ->first();

        $my_activities->fill($request->all())->update();

        return $my_activities;
    }
}

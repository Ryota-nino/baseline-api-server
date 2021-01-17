<?php

namespace App\Http\Controllers\EmploymentStatus;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\EditEmploymentStatusRequest;
use App\Models\Company;

class EditEmploymentStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(EditEmploymentStatusRequest $request)
    {
        $user = Auth::user();
        $company = Company::query()->findOrFail($request->company_id);
        $company->users()->syncWithoutDetaching([$user->id=>$request->all()]);
    }
}

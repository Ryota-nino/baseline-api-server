<?php

namespace App\Http\Controllers\EmploymentStatus;

use App\Http\Controllers\Controller;
use App\Models\EmploymentStatus;
use Illuminate\Support\Facades\Auth;

class ShowEmploymentStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $user = Auth::user();
        $status = 200;
        $emp_status = EmploymentStatus::query()->where('user_id', $user->id)->where('company_id', $id)->firstOrFail();

        return response()->json(
            $emp_status, $status
        );
    }
}

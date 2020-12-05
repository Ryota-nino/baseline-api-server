<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id = null)
    {
        // idがないときに自分のidに表示
        if (!$id) {
            $id = Auth::user()->id;
        }

        return User::query()
            ->with(
                'desired_occupation',
                'company_information.my_activities',
                'company_information.occupational_category',
                'company_information.company_comments',
                'company_information.selections',
                'company_information.entries',
                'company_information.interviews.interview_contents'
            )
            // 登録順にソート
            ->with(['company_information' => function ($query) {
                $query->orderBy('id', 'desc');
            }])
            ->findOrFail($id);
    }
}

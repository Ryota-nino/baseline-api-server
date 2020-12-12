<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;

class DetailCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        return Company::query()
            ->with(
                'prefectures',
                'company_information.user',
                'company_information.internship',
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

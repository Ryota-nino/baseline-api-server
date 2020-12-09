<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DetailCompanyUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Company $company
     * @param User $user
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Company $company, User $user, Request $request)
    {
        $user->load(
            'desired_occupation',
            'company_information.occupational_category',
            'company_information.company_comments',
            'company_information.selections',
            'company_information.entries',
            'company_information.interviews.interview_contents'
        );


        return response()->json([
            'company' => $company,
            'user' => $user
        ]);
    }
}

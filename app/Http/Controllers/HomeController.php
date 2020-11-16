<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\MyActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $companies = Company::with('prefectures')->orderBy('created_at', 'desc')->limit(4)->get();

        $result_companies = [];

        foreach ($companies as $company) {
            array_push($result_companies, [
                "id" => $company->id,
                "frigana" => $company->frigana,
                "company_name" => $company->company_name,
                "business_description" => $company->business_description,
                "number_of_employees" => $company->number_of_employees,
                "logo_path" => $company->logo_path,
                "company_url" => $company->company_url,
                "created_at" => $company->created_at,
                "updated_at" => $company->updated_at,
                "prefectures" => array_column($company->prefectures->toArray(), 'name'),
            ]);
        }


        // ログインユーザの取得
        $user = Auth::user();

        $my_activities = MyActivity::with('users');

        // アクティビティを取得し投稿者を表示
        $my_activity = $my_activities->where("posted_by", "like", $user->id)->orderBy('created_at', 'desc')->limit(2)->get();;
        $other_activity = $my_activities->where("posted_by", "not like", $user->id)->orderBy('created_at', 'desc')->limit(3)->get();

        return response()->json([
            "companies" => $result_companies,
            "my_activities" => $my_activity,
            "other_activities" => $other_activity
        ]);
    }
}

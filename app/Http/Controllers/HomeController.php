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
        $companies = Company::with('prefectures:name')->orderBy('created_at', 'desc')->limit(4)->get();

        // ログインユーザの取得
        $user = Auth::user();

        // アクティビティを取得し投稿者を表示
        $my_activities = MyActivity::with('users')->where("posted_by", "like", $user->id)->orderBy('created_at', 'desc')->limit(2)->get();;
        $other_activities = MyActivity::with('users')->where("posted_by", "not like", $user->id)->orderBy('created_at', 'desc')->limit(3)->get();

        return response()->json([
            "companies" => $companies,
            "my_activities" => $my_activities,
            "other_activities" => $other_activities
        ]);
    }
}

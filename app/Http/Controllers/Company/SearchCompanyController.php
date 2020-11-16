<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class SearchCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // クエリから都道府県idのリストを取得
        $prefecture_id = $request->query('prefecture_id');

        // クエリからフリーワード検索
        $free_word = $request->query('free_word');

        // クエリから事業内容を取得
        $business_description = $request->query('business_description');

        //TODO 新規か古いか
        //TODO 人数

        $companies = Company::query()->with('prefectures:name');

        // 都道府県からor検索
        if ($prefecture_id) {
            $companies->whereHas('prefectures', function ($query) use ($prefecture_id) {
                $query->whereIn('id', $prefecture_id);
            });
        }

        // フリーワードで検索
        if ($free_word) {
            // 優先順を下げるためにクエリスコープメソッドを仕様
            // これによりフリーワードの優先順位が低くなりフリーワード<事業内容and都道府県になる
            $companies->where(function ($query) use ($free_word) {
                // 企業名（フリガナ）
                $query->where('frigana', 'like', "%$free_word%")
                    // 企業名
                    ->orWhere('company_name', 'like', "%$free_word%")
                    // 事業内容
                    ->orWhere('business_description', 'like', "%$free_word%");
            });

        }

        // 事業内容で検索
        if ($business_description) {
            $companies->where('business_description', 'like', "%$business_description%");
        }

        //TODO パース処理
        $company_paginate = $companies->paginate();

        $result_companies = [];

//        foreach ($company_paginate->items() as $company) {
//            array_push($result_companies, [
//                "id" => $company->id,
//                "frigana" => $company->frigana,
//                "company_name" => $company->company_name,
//                "business_description" => $company->business_description,
//                "number_of_employees" => $company->number_of_employees,
//                "logo_path" => $company->logo_path,
//                "company_url" => $company->company_url,
//                "created_at" => $company->created_at,
//                "updated_at" => $company->updated_at,
//                "prefectures" => array_column($company->prefectures->toArray(), 'name'),
//            ]);
//        }


        return $company_paginate;
//        return response()->json([
//            "current_page" => $company_paginate->currentPage(),
//            "data" => $result_companies,
//            "first_page_url" => $company_paginate->firstItem()
//        ]);

    }
}

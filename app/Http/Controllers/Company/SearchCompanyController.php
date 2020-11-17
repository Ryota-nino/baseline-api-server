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

        // 古い順
        $older = $request->query('older');

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

        // 最新順にする処理
        // older（古い順）がtrueなら以下は実行されない
        if ($older == false) {
            $companies->orderBy('created_at', 'desc');
        }

        $company_paginate = $companies->paginate();


        return $company_paginate;

    }
}

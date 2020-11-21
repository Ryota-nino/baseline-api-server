<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;

class DetailCompanyController extends Controller
{
    private static function getCompanyArray($company_information)
    {
        return [
            'id' => $company_information->company_id,
            'frigana' => $company_information->frigana,
            'company_name' => $company_information->company_name,
            'business_description' => $company_information->business_description,
            'number_of_employees' => $company_information->number_of_employees,
            'logo_image_url' => asset($company_information->logo_path),
        ];
    }

    private static function getUserArray($company_information)
    {
        return [
            'id' => $company_information->user_id
        ];
    }

    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
//        $cis = DB::table('companies', 'c')
//            ->leftJoin('company_information as ci', 'c.id', '=', 'ci.company_id') // 企業と企業情報
//            ->leftJoin('users as u', 'ci.user_id', '=', 'u.id') // ユーザ情報
//            ->leftJoin('company_comments as cc', 'ci.id', '=', 'cc.company_information_id') // コメント
//            ->leftJoin('selections as cs', 'ci.id', '=', 'cs.company_information_id') // 選考
//            ->where('c.id', '=', "$id")
//            ->get([
//                'c.id as company_id', // 企業
//                'c.frigana',
//                'c.company_name',
//                'c.business_description',
//                'c.number_of_employees',
//                'c.company_url',
//                'c.logo_path',
//                'u.id as user_id', // 投稿者情報 //TODO 企業情報
//                DB::raw('(CASE
//                WHEN cc.id IS NOT NULL THEN "company_comment" -- コメント
//                WHEN cs.id IS NOT NULL THEN "selection" -- 選考
//                END) AS TYPE'),
//                'cc.comment_content', // 企業コメント
//                'cc.company_information_id'
//            ]);
////            ->get();
//
//        // 返すデータ
//        $response_data = collect([]);
//        $information = collect([]);
//
//        // 企業情報
//        $response_data->put('company', self::getCompanyArray($cis[0]));
//
//
//        foreach ($cis as $ci) {
//            // 企業コメント
//            switch ($ci->TYPE) {
//                case "company_comment":
//                    $company_comment = collect([]);
//                    $company_comment->put('type', 'company_comment');
//                    $company_comment->put('comment_content', $ci->comment_content);
//                    $company_comment->put('posted_by', self::getUserArray($ci)); // 投稿者データを追加
//
//                    $information->add($company_comment->toArray());
//                    break;
//
//                case "selection":
//                    $selection = collect([]);
//                    $selection->put('type', 'selection');
//
//                    $selection->put('posted_by', self::getUserArray($ci)); // 投稿者データを追加
//
//                    $information->add($selection->toArray());
//                    break;
//            }
//        }
//
//        $response_data->put('information', $information->toArray());
//
//
//        return response()->json($response_data);
////        return $cis;
///
//        return CompanyInformation::with('selections', 'company_comments', 'user')->find(3);
        return Company::with(
            'company_information.user',
            'company_information.company_comments',
            'company_information.selections',
            'company_information.entries',
            'company_information.interviews.interview_contents'
        )->findOrFail($id);
    }
}

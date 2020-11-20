<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;

class RegistCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(CompanyRequest $request)
    {
        $company = new Company();
        $status = 200;
        $message = 'OK';
        $logo_path = "";

        $company->fill($request->all());

        // 画像が送信されてきているとき;
        if ($request->logo_image) {
            // 画像のバリデーション
            $request->validate([
                'logo_image' => [
                    'regex:/data:image\/(jpg|jpeg|png);base64,\//'
                ],
            ]);

            // 画像を保存しそのpathを返す処理
            $logo_path = StoreCompanyImage::storeImage($request->logo_image);
        }

        if (!$company->fill(['logo_path' => $logo_path])->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        //都道府県と紐付け
        $company->prefectures()->attach($request->prefecture_id);

        return response()->json([
            'message' => $message
        ], $status);
    }
}

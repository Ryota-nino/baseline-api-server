<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Storage;

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
                    'regex:/data:image\/jpeg;base64,\//'
                ],
            ]);

            // 画像を保存してPathを取得する処理
            $image = $request->logo_image;  // base64
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Uuid::uuid() . '.' . 'jpeg';

            //TODO サイズのバリデート

            // 画像を保存
            Storage::disk('public')->put($imageName, base64_decode($image));
            // パスの取り出し
            $logo_path = Storage::url($imageName);
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

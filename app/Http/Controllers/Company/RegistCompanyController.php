<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegistCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        //validate
        $request->validate([
            'frigana' => [
                'required',
                'regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u'
            ],
            'company_name' => 'required',
            'business_description' => 'required',
            'prefecture_id' => 'required|array',
            'prefecture_id.*' => 'integer|between:1,47',
            'number_of_employees' => 'required|integer',
            'logo_image' => [
                'required',
                'regex:/data:image\/jpeg;base64,\//'
            ],
            'company_url' => 'required|url',
        ]);

        $image = $request->logo_image;  // base64
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Uuid::uuid() . '.' . 'jpeg';

        //TODO サイズのバリデート

        // 画像を保存
        Storage::put($imageName, base64_decode($image));
        // パスの取り出し
        $logo_path = Storage::url($imageName);

        $company = new Company();
        $status = 200;
        $message = 'OK';

        if (!$company->fill($request->all())->fill(['logo_path' => $logo_path])->save()) {
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

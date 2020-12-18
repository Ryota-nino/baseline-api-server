<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Storage;

class EditCompanyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Company $company, CompanyRequest $request)
    {
        $company->prefectures()->detach();
        $company->prefectures()->attach($request->prefecture_id);

        $company->fill($request->all());

        if ($request->logo_image) {
            // 画像のバリデーション
            $request->validate([
                'logo_image' => [
                    'regex:/data:image\/(jpg|jpeg|png);base64,/'
                ],
            ]);

            $old_logo_path = basename($company->logo_path);

            // 画像を保存しそのpathを返す処理
            try {
                $new_logo_path = StoreCompanyImage::storeImage($request->logo_image);
                $company->fill(['logo_path' => $new_logo_path]);

                // 前の画像を削除する処理
                Storage::disk('public')->delete($old_logo_path);

            } catch (Exception $e) {
                // 画像保存が失敗したとき
                return response()->json([
                    'message' => 'SaveFailedError',
                ], 400);

            }
        }

        $company->update();

        return response()->json([
            'message' => 'OK',
            'data' => $company
        ], 200);
    }
}

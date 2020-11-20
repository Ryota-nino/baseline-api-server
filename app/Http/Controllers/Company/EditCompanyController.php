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
    public function __invoke($id, CompanyRequest $request)
    {
        $status = 200;
        $message = 'OK';
        $logo_path = "";

        $company = Company::findOrfail($id);

        $company->prefectures()->detach();
        $company->prefectures()->attach($request->prefecture_id);

        $company->fill($request->all());

        // 画像が送信されてきているとき;
        if ($request->logo_image) {
            // 画像のバリデーション
            $request->validate([
                'logo_image' => [
                    'regex:/data:image\/(jpg|jpeg|png);base64,/'
                ],
            ]);

            // 前の画像を削除する処理
            Storage::disk('public')->delete(basename($company->logo_path));

            // 画像を保存しそのpathを返す処理
            try {
                $logo_path = StoreCompanyImage::storeImage($request->logo_image);
            } catch (Exception $e) {
                // 画像保存が失敗したとき
                $logo_path = "";
            }
        }

        $company->fill(['logo_path' => $logo_path])->update();

        return response()->json([
            'message' => $message,
            'data' => $company
        ], $status);
    }
}

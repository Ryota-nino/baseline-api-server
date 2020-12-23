<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditUserProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id, Request $request)
    {
        $validated_request = $request->validate([
            'student_number' => 'required|integer|digits:7',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'annual' => 'required|integer|min:1',
            'sex' => 'required|integer|between:0,2', // 0:男, 1:女, 2:その他
            'year_of_graduation' => 'required|integer|digits:2',
            'desired_occupations' => 'required|exists:occupational_categories,id',
        ]);

        $user = User::query()->findOrFail($id);
        $status = 200;
        $message = 'OK';

        if ($request->icon) {
            // 画像のバリデーション
            $request->validate([
                'logo_image' => [
                    'regex:/data:image\/(jpg|jpeg|png);base64,/'
                ],
            ]);

            $old_icon_path = basename($user->icon_image_path);

            // 画像を保存しそのpathを返す処理
            try {
                $new_icon_path = StoreUserIcon::storeIcon($request->icon);
                $user->fill(['icon_image_path' => $new_icon_path]);

                // 前の画像を削除する処理
                Storage::disk('public')->delete($old_icon_path);

            } catch (Exception $e) {
                // 画像保存が失敗したとき
                return response()->json([
                    'message' => 'SaveFailedError',
                ], 400);

            }
        }

        if (!$user->fill($validated_request)->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

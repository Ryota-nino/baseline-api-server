<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        // バリデーション
        $validated_request = $request->validate([
            'token' => 'required|string',
            'student_number' => 'required|integer|digits:7',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'sex' => 'required|integer|between:0,2', // 0:男, 1:女, 2:その他
            'annual' => 'required|integer|min:1',
            'year_of_graduation' => 'required|integer|digits:2',
            'desired_occupations' => 'required|exists:occupational_categories,id',
            'password' => 'required'
        ]);

        ['token' => $token] = $validated_request;

        $user = User::query()
            ->where('email_verify_token', 'like', "$token")
            ->whereNull('email_verified_at')
            ->firstOrFail();

        // 登録処理
        $status = 200;
        $message = 'OK';
        $icon_path = ""; // 画像のパス


        //TODO 認証済みユーザを表示するグローバルスコープおよび例外をここで使う

        // 画像が送信されているとき
        if ($request->icon) {
            // 画像のバリデーション
            $request->validate([
                'icon' => [
                    'regex:/data:image\/(jpg|jpeg|png);base64,/'
                ],
            ]);

            // 画像を保存しそのpathを返す処理
            $icon_path = StoreUserIcon::storeIcon($request->icon);
        }

        if (!$user->fill($validated_request)
            ->fill([
                'password' => Hash::make($validated_request['password']),
                'icon_image_path' => $icon_path,
                'email_verified_at' => now()
            ])->save()) {
            $status = 400;
            $message = 'Bad Request';
        }


        return response()->json([
            'message' => $message
        ], $status);
    }
}

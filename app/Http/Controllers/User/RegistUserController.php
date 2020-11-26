<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class RegistUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(UserRequest $request)
    {
        $user = new User(); // ユーザ
        $icon_path = "";
        $status = 200;
        $message = 'OK';

        //TODO メール送らなきゃダメやん草

        $user->fill($request->all());

        //TODO 画像が尊信されているとき
        if ($request->icon) {
            //TODO 画像のバリデーション
            $request->validate([
                'icon' => [
                    'regex:/data:image\/(jpg|jpeg|png);base64,/'
                ],
            ]);

            //TODO 画像を保存しそのpathを返す処理
        }

        if (!$user->fill(['icon_image_path' => $icon_path, 'privilege' => 0])->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

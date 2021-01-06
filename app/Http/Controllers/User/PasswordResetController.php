<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $validated_request = $request->validate([
            'token' => 'required|string',
            'new_password' => "required|confirmed|different:current_password"
        ]);

        ['token' => $token] = $validated_request;

        $password_reset = PasswordReset::query()
            ->where('token', 'like', "$token")
            ->firstOrFail();
//
//        if (!$password_reset
//            ->exists()
//        ) {
//            // 存在しなかったとき
//            return \response()->json([
//                "message" => "Bad request"
//            ], 400);
//        }

        // メールのユーザーを見つける
        $user = User::query()
            ->where('email', 'like', "$password_reset->email")
            ->firstOrFail();

        $user->password = Hash::make($request->new_password);

        if (!$user->save()) {
            return \response()->json([
                "message" => "Bad request"
            ], 400);
        }

        $password_reset->delete();

        return \response()->json([
            "message" => "OK"
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            // 現在のパスワードが一致するか
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if ((!\Hash::check($value, \Auth::user()->password))) {
                    return $fail("パスワードが一致しません");
                }
            }],
            // 新しいパスワード
            'new_password' => "required|confirmed|different:current_password"
        ]);

        $user = \Auth::user();
        $status = 200;
        $message = "OK";

        $user->password = Hash::make($request->new_password);
        if (!$user->save()) {
            $status = 401;
            $message = "Bad Request";
        }

        return response()->json(
            $message, $status
        );


    }
}

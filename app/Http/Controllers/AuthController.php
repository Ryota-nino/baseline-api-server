<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'active' => 'required|boolean',
        ]);

        // 初期値ログインに成功したりすると値が変更変わる
        $status = 401;
        $message = 'Unauthorized';

        // ログインするための情報
        $credential = $request->only(['email', 'password']);

        // 認証実行
        if (Auth::attempt($credential)) {
            // 認証成功
            $status = 200;
            $message = 'OK';
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

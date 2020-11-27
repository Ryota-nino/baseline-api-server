<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\RegistUserMail;
use App\Models\User;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TemporaryRegistationUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = new User(); // ユーザ
        $status = 200;
        $message = 'OK';

        // バリデーション
        $request->validate([
            'email' => 'required|email|unique:users'
        ]);

        if (!$user->fill(['email' => $request->email])->save()) {
            $status = 400;
            $message = 'Bad Request';
        } else {
            // トークンを取得する処理
            $token = Uuid::uuid();
            $user->fill(['email_verify_token' => $token])->save();

            Mail::to($request->email)->send(new RegistUserMail($token));
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

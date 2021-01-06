<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PasswordResetToMailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //メールからユーザを取り出す処理
        $this->validate($request, ['email' => 'required|email']);

        // トークンの作成
        // なければ作成
        $password_reset = PasswordReset::query()
            ->where('email', '=', $request->email)
            ->firstOrCreate(
                ['email' => $request->email]
            );

        $password_reset->fill(['token' => Uuid::uuid4(), 'created_at' => now()]);
        $password_reset->save();

        //TODO メールを送る


        //TODO　
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PasswordResetController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        //メールからユーザを取り出す処理
        $this->validate($request, ['email' => 'required|email']);

        $user = User::query()->where('email', 'like', $request->email)->firstOrFail();


        //TODO トークンの作成

        //TODO メールを送る


        //TODO　
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        // 希望職種idを取得
        $desired_occupations_id = $user->desired_occupations;

        // もし希望職種がnull以外であれば職種名を取得して代入する
        if ($desired_occupations_id) {
            $user->desired_occupations = User::find($user->id)->desired_occupation()->first('name')->name;
        }

        return $user;
    }
}

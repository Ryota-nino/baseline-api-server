<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $status = 401;
        $message = 'Unauthorized';

        if (Auth::attempt($credential)) {
            $status = 200;
            $message = 'OK';
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

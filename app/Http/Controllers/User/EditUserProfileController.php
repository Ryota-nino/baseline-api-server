<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditUserProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($id, Request $request)
    {
        $validated_request = $request->validate([
            'student_number' => 'required|integer|digits:7',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'annual' => 'required|integer|min:1',
            'sex' => 'required|integer|between:0,2', // 0:男, 1:女, 2:その他
            'year_of_graduation' => 'required|date',
            'desired_occupations' => 'required|exists:occupational_categories,id',
        ]);

        $user = User::query()->findOrFail($id);
        $status = 200;
        $message = 'OK';

        if (!$user->fill($request->all())->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

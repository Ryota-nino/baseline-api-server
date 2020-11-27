<?php

namespace App\Http\Controllers\Draft;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use App\Http\Requests\DraftRequest;
use Illuminate\Support\Facades\Auth;

class RegistDraftController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(DraftRequest $request)
    {
        $user = Auth::user();
        $draft = new Draft();
        $status = 200;
        $message = 'OK';

        $draft->posted_by = $user->id;
        if(!$draft->fill($request->all())->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

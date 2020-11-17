<?php

namespace App\Http\Controllers\Draft;

use App\Http\Controllers\Controller;
use App\Models\Draft;
use App\Http\Requests\DraftRequest;
use Illuminate\Http\Request;

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
        $draft = new Draft();
        $status = 200;
        $message = 'OK';

        if(!$draft->fill($request->all())->save()) {
            $status = 400;
            $message = 'Bad Request';
        }

        return response()->json([
            'message' => $message
        ], $status);
    }
}

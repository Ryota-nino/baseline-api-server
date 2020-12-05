<?php

namespace App\Http\Controllers\Selection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SelectionRequest;
use App\Models\Selection;

class EditSelectionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $selection = Selection::findOrfail($id);
        $selection->title = $request->title;
        $selection->content = $request->content;
        $selection->update();

        return response()->json([
            'message' => 'OK',
            'data' => $selection
        ], 200);
    }
}

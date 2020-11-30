<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;

class EditEntryController extends Controller
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

        $entry = Entry::findOrfail($id);
        $entry->title = $request->title;
        $entry->content = $request->content;
        $entry->update();

        return response()->json([
            'message' => 'OK',
            'data' => $entry
        ], 200);
    }
}

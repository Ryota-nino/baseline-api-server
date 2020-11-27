<?php

namespace App\Http\Controllers\OccupationalCategory;

use App\Http\Controllers\Controller;
use App\Models\OccupationalCategory;
use Illuminate\Http\Request;

class IndexOccupationalCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return OccupationalCategory::all();
    }
}

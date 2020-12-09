<?php

namespace App\Http\Controllers\Internship;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IndexInternships extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        return response()->json(
            Internship::all()
        );
    }
}

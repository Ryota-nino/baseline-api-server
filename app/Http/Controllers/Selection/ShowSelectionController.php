<?php

namespace App\Http\Controllers\Selection;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use Illuminate\Http\JsonResponse;

class ShowSelectionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param CompanyInformation $companyInformation
     * @return JsonResponse
     */
    public function __invoke(CompanyInformation $companyInformation)
    {
        $status = 200;
        $selection = $companyInformation->load('selections');

        if ($selection->selections->count() == 0) {
            abort(404);
        }

        return response()->json(
            $selection, $status
        );
    }
}

<?php

namespace App\Http\Controllers\Entry;

use App\Http\Controllers\Controller;
use App\Models\CompanyInformation;
use Illuminate\Http\JsonResponse;

class ShowEntryController extends Controller
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
        $entry = $companyInformation->load('entries');

        if ($entry->entries->count() == 0) {
            abort(404);
        }

        return response()->json(
            $entry, $status
        );
    }
}

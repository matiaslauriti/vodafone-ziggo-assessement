<?php

namespace App\Http\Controllers;

use App\Domain\Enums\ScanStatus;
use App\Jobs\ImportCustomers;
use App\Models\Scan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Inertia\Response as InertiaResponse;

class ScanController extends Controller
{
    public function index(): InertiaResponse
    {
        return inertia(
            'Scan/Index',
            ['scans' => Scan::with('customers')->paginate(2)->toResourceCollection()],
        );
    }

    public function store(): Response
    {
        dispatch(new ImportCustomers);

        return response()->noContent();
    }

    public function scanInProgress(): JsonResponse
    {
        return response()->json([
            'in_progress' => Scan::whereStatus(ScanStatus::IN_PROGRESS)->exists(),
        ]);
    }
}

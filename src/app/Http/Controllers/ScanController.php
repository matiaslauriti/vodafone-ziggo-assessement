<?php

namespace App\Http\Controllers;

use App\Domain\Enums\ScanStatus;
use App\Jobs\ImportCustomers;
use App\Models\Scan;
use Illuminate\Http\Request;
use Inertia\Response;

class ScanController extends Controller
{
    public function index(): Response
    {
        return inertia(
            'Scan/Index',
            ['scans' => Scan::with('customers')->paginate(2)->toResourceCollection()],
        );
    }

    public function create()
    {
        dispatch(new ImportCustomers);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}

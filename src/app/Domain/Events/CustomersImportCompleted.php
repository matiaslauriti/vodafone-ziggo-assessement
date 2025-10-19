<?php

namespace App\Domain\Events;

use App\Models\Scan;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomersImportCompleted
{
    use Dispatchable, SerializesModels;

    public function __construct(public Scan $scan) {}
}

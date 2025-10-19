<?php

namespace App\Jobs;

use App\Domain\Classes\FraudulentCheckers\SimpleFraudulentChecker;
use App\Domain\Classes\ScannerProcessor;
use App\Domain\Contracts\FraudulentCheckerContract;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportCustomers implements ShouldQueue
{
    use Queueable;

    public function __construct(private FraudulentCheckerContract $checker = new SimpleFraudulentChecker) {}

    public function handle(): void
    {
        new ScannerProcessor()->fetchAndSave();
    }
}

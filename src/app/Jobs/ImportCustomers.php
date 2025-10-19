<?php

namespace App\Jobs;

use App\Domain\Classes\ScannerProcessor;
use App\Domain\Classes\SimpleFraudulentChecker;
use App\Domain\Contracts\FraudulentCheckerInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportCustomers implements ShouldQueue
{
    use Queueable;

    public function __construct(private FraudulentCheckerInterface $checker = new SimpleFraudulentChecker) {}

    public function handle(): void
    {
        new ScannerProcessor()->fetchAndSave();
    }
}

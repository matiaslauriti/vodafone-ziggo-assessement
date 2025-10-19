<?php

namespace App\Domain\Listeners;

use App\Domain\Contracts\FraudulentCheckerContract;
use App\Domain\Enums\ScanStatus;
use App\Domain\Events\CustomersImportCompleted;
use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ValidateCustomers implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(private FraudulentCheckerContract $checker) {}

    public function handle(CustomersImportCompleted $event): void
    {
        $scan = $event->scan;

        $scan->update(['status' => ScanStatus::IN_PROGRESS]);

        $scan
            ->customers()
            ->each(function (Customer $customer) {
                $errors = $this->checker->validate($customer);

                $customer->update([
                    'error_message' => ! empty($errors) ? collect($errors)->flatten()->join(', ') : null,
                ]);
            });

        $scan->update(['status' => ScanStatus::COMPLETED]);
    }

    public function failed(CustomersImportCompleted $event): void
    {
        $event->scan->update(['status' => ScanStatus::FAILED]);
    }
}

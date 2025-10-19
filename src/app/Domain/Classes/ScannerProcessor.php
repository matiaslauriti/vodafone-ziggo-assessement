<?php

namespace App\Domain\Classes;

use App\Domain\Enums\ScanStatus;
use App\Domain\Events\CustomersImportCompleted;
use App\Facades\CustomerFetcherFacade;
use App\Models\Customer;
use App\Models\Scan;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Throwable;

class ScannerProcessor
{
    public function fetch(): Collection
    {
        return CustomerFetcherFacade::fetch();
    }

    public function fetchAndSave(): void
    {
        $scan = Scan::create();

        try {
            $this->fetch()
                ->each(function (array $customer) use ($scan) {
                    Customer::create([
                        'scan_id' => $scan->id,

                        'external_customer_id' => $customer['customerId'],

                        'first_name' => $customer['firstName'],
                        'last_name' => $customer['lastName'],

                        'bsn' => $customer['bsn'],
                        'iban' => $customer['iban'],

                        'date_of_birth' => Carbon::parse($customer['dateOfBirth']),

                        'street' => $customer['address']['street'],
                        'postal_code' => $customer['address']['postcode'],
                        'city' => $customer['address']['city'],

                        'phone_number' => $customer['phoneNumber'],

                        'products' => $customer['products'],

                        'tag' => $customer['tag'],

                        'ip_address' => $customer['ipAddress'],
                        'last_invoice_at' => Carbon::parse($customer['lastInvoiceDate']),
                        'last_login_at' => Carbon::parse($customer['lastLoginDateTime']),
                    ]);
                });

            event(new CustomersImportCompleted($scan));
        } catch (Throwable) {
            $scan->update(['status' => ScanStatus::FAILED]);
        }
    }
}

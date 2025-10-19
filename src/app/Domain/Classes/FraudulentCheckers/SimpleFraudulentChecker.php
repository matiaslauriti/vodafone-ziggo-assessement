<?php

namespace App\Domain\Classes\FraudulentCheckers;

use App\Domain\Contracts\FraudulentCheckerContract;
use App\Models\Customer;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use stdClass;

class SimpleFraudulentChecker implements FraudulentCheckerContract
{
    private array $customerIdsWithSameIpOrIban = [];

    private int $scanId = 0;

    public function validate(Customer $customer): array
    {
        $this->loadDuplicatedIpOrIbanCustomersIds($customer);

        $errors = [];

        if (!Str::startsWith($customer->phone_number, '+31')) {
            $errors[] = 'Customer has non-NL phone nr.';
        }

        if ($customer->date_of_birth->diffInYears() < 18) {
            $errors[] = 'Customer is underage';
        }

        if ($duplicatedIpOrIbanCustomer = $this->customerIdsWithSameIpOrIban[$customer->id] ?? null) {
            $errors[] = "Duplicated IP or IBAN number with customer $duplicatedIpOrIbanCustomer";
        }

        return $errors;
    }

    private function loadDuplicatedIpOrIbanCustomersIds(Customer $customer): void
    {
        $this->scanId = $customer->scan_id;

        $this->customerIdsWithSameIpOrIban = Cache::memo()->remember("scan_{$customer->scan_id}", 1800, function () {
            return DB::table('customers', 'c1')
                ->select('id', 'first_name', 'last_name')
                ->whereExists(function (Builder $query) {
                    return $query->select(DB::raw(1))
                        ->from('scans')
                        ->where('scan_id', $this->scanId);
                })
                ->whereExists(function (Builder $query) {
                    return $query->select(DB::raw(1))
                        ->from('customers', 'c2')
                        ->whereColumn('c1.id', '!=', 'c2.id')
                        ->where(function (Builder $query) {
                            return $query->whereColumn('c1.iban', '=', 'c2.iban')
                                ->orWhereColumn('c1.ip_address', '=', 'c2.ip_address');
                        });
                })
                ->get()
                ->mapWithKeys(function (stdClass $customer) {
                    return [$customer->id => "$customer->first_name $customer->last_name"];
                })
                ->toArray();
        });
    }

    public function __destruct()
    {
        Cache::forget("scan_{$this->scanId}");
    }
}

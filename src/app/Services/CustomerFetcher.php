<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * @phpstan-type CustomerType array{customerId: int, bsn: int, firstName: string, lastName: string, dateOfBirth: string, phoneNumber: string, email: string, tag: string, ipAddress: string, iban: string, lastInvoiceDate: string, lastLoginDateTime: string, products: list<string>, address: array{street: string, postcode: string, city: string}}
 */
class CustomerFetcher
{
    /**
     * @return Collection<int, CustomerType>
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetch(): Collection
    {
        return Http::baseUrl(config('services.customers.base_uri'))
            ->get(config('services.customers.api_uri'))
            ->throw()
            ->collect('customers');
    }
}

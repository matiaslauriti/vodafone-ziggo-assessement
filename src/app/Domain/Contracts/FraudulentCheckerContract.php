<?php

namespace App\Domain\Contracts;

use App\Models\Customer;

interface FraudulentCheckerContract
{
    /**
     * @param Customer $customer Customer's data to be validated.
     *
     * @return array<string, list<string>> Non-empty array when there is an error on any data's index. The index is the same and the value is an array of errors for that index.
     */
    public function validate(Customer $customer): array;
}

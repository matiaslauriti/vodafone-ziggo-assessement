<?php

namespace App\Domain\Contracts;

interface FraudulentCheckerInterface
{
    /**
     * @param array $customer Customer's data, as an array, to be validated.
     *
     * @return array<string, list<string>> Non-empty array when there is an error on any data's index. The index is the same and the value is an array of errors for that index.
     */
    public function validate(array $customer): array;
}

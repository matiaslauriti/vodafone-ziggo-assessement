<?php

namespace App\Domain\Classes;

use App\Domain\Contracts\FraudulentCheckerInterface;

/**
 * What is fraudulent activity?
 * - Two customers with the same IP-address or same IBAN are both fraudulent.
 * - A customer with a phone number from outside the Netherlands is fraudulent.
 * - A customer that is younger than 18 years old is fraudulent.
 */
class SimpleFraudulentChecker implements FraudulentCheckerInterface
{
    private array $ip = [];
    private array $iban = [];

    public function validate(array $customer): array
    {

    }
}

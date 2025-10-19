<?php

namespace App\Facades;

use App\Services\CustomerFetcher;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin CustomerFetcher
 */
class CustomerFetcherFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CustomerFetcher::class ;
    }
}

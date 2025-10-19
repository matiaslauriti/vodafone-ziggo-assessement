<?php

namespace App\Facades;

use App\Services\Customer\API\Fetcher;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin Fetcher
 */
class CustomerFetcherFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Fetcher::class ;
    }
}

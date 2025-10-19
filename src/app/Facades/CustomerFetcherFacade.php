<?php

namespace App\Facades;

use App\Services\CustomerApi;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin CustomerApi
 */
class CustomerFetcherFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CustomerApi::class ;
    }
}

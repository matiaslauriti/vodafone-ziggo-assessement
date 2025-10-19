<?php

namespace App\Providers;

use App\Domain\Classes\FraudulentCheckers\SimpleFraudulentChecker;
use App\Domain\Contracts\FraudulentCheckerContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FraudulentCheckerContract::class, SimpleFraudulentChecker::class);
    }
}

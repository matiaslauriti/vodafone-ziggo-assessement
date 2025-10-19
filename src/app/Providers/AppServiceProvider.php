<?php

namespace App\Providers;

use App\Domain\Classes\SimpleFraudulentChecker;
use App\Domain\Contracts\FraudulentCheckerInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FraudulentCheckerInterface::class, SimpleFraudulentChecker::class);
    }
}

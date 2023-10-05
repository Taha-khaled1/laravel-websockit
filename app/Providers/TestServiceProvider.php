<?php

namespace App\Providers;

use App\Contracts\FixedAmountDiscountCalculator;
use App\Contracts\PercentageDiscountCalculator;
use Illuminate\Support\ServiceProvider;

class TestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
   $this->app->bind( FixedAmountDiscountCalculator::class,PercentageDiscountCalculator::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
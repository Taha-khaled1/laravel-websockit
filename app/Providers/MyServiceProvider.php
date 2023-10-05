<?php

namespace App\Providers;

use App\Contracts\DiscountCalculator;
use App\Contracts\FixedAmountDiscountCalculator;
use App\Contracts\PercentageDiscountCalculator;
use Illuminate\Support\ServiceProvider;



class MyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(DiscountCalculator::class, PercentageDiscountCalculator::class); 
        // تقدر تغير برحتك بقي لو عاوز تستخدم الدوال اللي داخل خلااص النسبه او لو عاوز تستخدم الدوال اللي داخل كلاس الثابت
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
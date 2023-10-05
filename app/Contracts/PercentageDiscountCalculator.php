<?php
namespace App\Contracts;
use App\Contracts\DiscountCalculator;
use App\Models\User;

class PercentageDiscountCalculator implements DiscountCalculator
{
    public function calculate(User $product)
    {
        return 15; // 10% discount
    }
}
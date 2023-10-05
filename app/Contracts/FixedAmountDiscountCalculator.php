<?php
namespace App\Contracts;
use App\Contracts\DiscountCalculator;
use App\Models\User;

/**
 * Summary of FixedAmountDiscountCalculator
 */
class FixedAmountDiscountCalculator implements DiscountCalculator
{
    /**
     * Summary of calculate
     * @param App\Models\User $product
     * @return float
     */
    public function calculate(User $product)
    {
        return 5.0; // $5 fixed discount
    }
}
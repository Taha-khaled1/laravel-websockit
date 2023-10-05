<?php

namespace App\Services;

use App\Contracts\DiscountCalculator;
use App\Models\User;

class DiscountService
{
    private $calculator;

    public function __construct(DiscountCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function applyDiscount(User $user)
    {
        return $this->calculator->calculate($user);
    }
}
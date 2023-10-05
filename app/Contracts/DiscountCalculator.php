<?php

namespace App\Contracts;

use App\Models\User;

interface DiscountCalculator
{
    public function calculate(User $product);
}
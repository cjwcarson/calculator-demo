<?php

namespace App\Services\Operators;

class SubtractOperator
{
    public function calculate($val1, $val2): float
    {   
        return $val1-$val2;
    }
}

<?php

namespace App\Services\Operators;


class AddOperator
{
    public function calculate($val1, $val2): float
    {           
        return $val1+$val2;
    }
}

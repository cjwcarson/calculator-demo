<?php

namespace App\Services\Operators;


class DivideOperator
{
    public function calculate($val1, $val2): float
    {   
        if($val1 == 0 ){
            return 0;
        }

        if($val2 == 0){
            echo "Cannot divide by zero.";
            /* as an improvement this should return a warning message to be properly rendered.
               should implement an operator class which uses a result object which contains 
               both a result and any errors/messages.
            */
            return 0;
        }

        return $val1/$val2;
    }
}

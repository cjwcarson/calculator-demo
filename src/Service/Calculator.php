<?php
// src/Service/Calculator.php
namespace App\Service;

use App\Services\Operators\AddOperator;
use App\Services\Operators\SubtractOperator;
use App\Services\Operators\DivideOperator;
use App\Services\Operators\MultiplyOperator;
use Symfony\Component\HttpFoundation\Request;

class Calculator
{

    private $numbers = [];
    private $operators = [];
    private $allowedOperators = array('-','+','/','*');
    private $result = 0;
    private $session;
    
    public function __construct()
    {
        $this->initOperators();
    }


    public function processInput(string $input): string
    {
        $characters = str_split($input);
        $length = count($characters);
        $i = 1;
        $number = '';

        foreach($characters as $character){

            if($i === 1 && in_array($character, $this->allowedOperators)){
                // checks that the calculation starts with a number and not an operator.
                return "Invalid calculation, cannot start with an operator."; 
            }

            if($i === $length && in_array($character, $this->allowedOperators)){
                // checks that the calculation ends with a number and not an operator.
                return "Invalid calculation, cannot end with an operator."; 
            }

            if(str_contains($number, '.') && $character === '.'){
                // checks to determine if two decimal points are in the same number.
                return 'Invalid calculation, cannot have two decimal points in the same number';
            }

            if(in_array($character, $this->allowedOperators)){
                // if the next characer in the string is an operator save the previous number and push to array.
                array_push($this->numbers,floatval($number));
                array_push($this->operators, $character);
                $number = '';
            }else if($i === $length){
                // if we are on the last character then save the final number to the numbers array to be processed.
                array_push($this->numbers, floatval($number.$character));
            }else{
                // number is more than one character long so append the current character to the end of the current number
                $number .= $character;
            }
            $i++;
        }

        if(count($this->numbers) === 1){
            return 'More than one number is required for a calculation!';
        }

        try{
            $result = $this->calculate();
        } catch ( Exception $e) {
            $result = 0;
        }

        return strval($result);
    }

    private function initOperators()
    {

        /* initialise operators allowed in the calculator */

        $this->addOperator = new AddOperator();
        $this->subtractOperator = new SubtractOperator();
        $this->divideOperator = new DivideOperator();
        $this->multiplyOperator = new MultiplyOperator();
                        
    }
    
    private function calculate(): float
    {
        $i = 0;
        for($i=0; $i!=count($this->numbers); $i++){
            if($i===0){
                /* if it is the first number in the calculation then we also want to grab the following operator and then the second number 
                    then increment the count twice as we have processed the first two values after this we just keep processing the following number.
                */
                $operator = array_shift($this->operators);
                $this->result = $this->process($this->numbers[$i],$this->numbers[$i+1], $operator);
                $i++;
            }else{
                $operator = array_shift($this->operators);
                $this->result = $this->process($this->result,$this->numbers[$i], $operator);
            }
        }
        return $this->result;
    }

    private function process(float $num1, float $num2, string $operator): float
    {

        /* process the first value against the operator before the second value and return result */

        switch ($operator){

            case "+":
                $result = $this->addOperator->calculate($num1, $num2);
                break;
            case "-":
                $result = $this->subtractOperator->calculate($num1, $num2);
                break;
            case "/":
                $result = $this->divideOperator->calculate($num1, $num2);
                break;
            case "*":
                $result = $this->multiplyOperator->calculate($num1, $num2);
                break;
        }

        return $result;

    }
   
}
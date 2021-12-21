<?php
// src/Entity/Calculation.php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Calculation
{
    //#[Assert\Regex('/^[a-zA-Z]*$/')] 
    protected $calculation;
    /* tried to get the assertion constrait working in this entity
     however could not get it working in the limited time I spent so implemented an 
     iscalculationValid function instead
    */

    public function isCalculationValid()
    {   
        return preg_match('/^[0-9+*\/.-]*$/', $this->calculation);
    }

    public function getCalculation()
    {
        return $this->calculation;
    }

    public function setCalculation(string $calculation)
    {
        $this->calculation = $calculation;
    }

}
<?php
namespace App\Controller;

use App\Service\Calculator;
use App\Entity\Calculation;
use App\Form\Type\CalculatorType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CalculatorController extends AbstractController
{
    /*
        routes are handled in config/routes.yaml default root is set to redirect the index function here.
    */
    
    /**
     * @Route("/calculator")
     */
    public function index(Calculator $calculator, Request $request): Response
    {

        $answerText = '';
        $calculation = new Calculation();

        $form = $this->createForm(CalculatorType::class, $calculation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if($calculation->isCalculationValid()){
                /* It would be good to handle more validation in here and the isCalculationValid check more sophisticated. 
                   Would be an improvement to move this check into the calculation service to reduce logic in the controller. 
                   $answerText should be an entity which if it doesn't contain a number then we can render the error message.
                   however due to time limitiation I am just returning a string representation of a float or a message eg invalid input
                */
                 $answerText = $calculator->processInput($calculation->getCalculation());
            }else{
                $calculation->setCalculation('');
                $form = $this->createForm(CalculatorType::class, $calculation);
                $answerText = 'Calculation contains illegal characters only [0-9] and * - + / operators are allowed.';
            };
            
            
            return $this->renderForm('base.html.twig', [
                'form' => $form,
                'answer' => $answerText
            ]);;
        }

        return $this->renderForm('base.html.twig', [
            'form' => $form,
            'answer' => $answerText
        ]);
    }


}
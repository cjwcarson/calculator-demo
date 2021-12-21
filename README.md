## Dependancies

 - PHP 7.2+
 - Composer 2.1+

## Instalation 
 
 - `composer install`

## Running Applicaiton

 - `symfony server:start`
 - server starts go to 127.0.0.1/8000 routing will direct through to the calculator controller.

## Notes

    I roughly spent about 6 hours on this, which is alot however I had to spend time reading through the sympfony documentation to even get a basic page setup in sympfony as I have never used it before.
    All my php expereince in the last couple of years has been in cake.php which is wildly different. Even after a few hours of using sympfoiny I can see many areas in which it enforces a better structured application. 

    I have covered validation so that any input entered has to pass a validation check ie opnly allow characters . 0-9 and /*-+ operators.
    Check that the calculation is valid ie more than one number is entered with at least one operator.
    Calculation input does not start or end with an operator.
    Cannot divide by 0 this will return 0 and display a message.
    Only allows one decimal point per number ie 1.23.1 will not be valid.

    There are numerous improvements I would have like to have made to the code which are covered below.

## Tests
 
    Below are the tests I have carried out to ensure the code / classes act as expected.
    
    AddOperator -> I expect 12+6 to return 18 and it does so passes.
    DivideOperator -> I expect 18/3 to return 6 and it does so passes.
    MultiplyOperator -> I expect 2*5 to return 10 and it does so passes.
    SubtractOperator -> I expect 0.5-1 to return -0.5 and it does so passes.

    Enter a calculation with a number with two '.'s in it -> I expect to see a validation error which is shown.
    Enter a calculation with an illegal character eg $  -> I expect to see a vallidation error which is shown.
    Enter a calculation with two operators next to each other -> I expect to see a vallidation error which is shown.
    Enter a calcualtion where we are dividing by 0 -> I expect to see an message saying cannot divide by zero which is shown.

## Improvements

    - Have a result entity so when we return a result we can have a float value and a message which can be displayed for better user feedback.
    - Enable the use of brackets, this would require rewriting or exttending the logic in the calculator class, perhaps even extending the calculator    class with scientific calculator class which has more operators.
    - More complex rules so we can follow thee correct mathematic bodmas so if we could process multiplication brackets and division in the correct order.
    - Handle the rendering of the form in the calculator service to mnake the controller simpler which is better practice. 
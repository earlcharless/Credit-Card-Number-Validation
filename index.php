<?php
/* INPUT YOUR CREDIT CARD NUMBER HERE */
$creditCardNumber = 371449635398431;


function validateCreditCardNumber($ccn)
{
    $arrCCN = array_map('intval', str_split($ccn));
    $arrCCNCount = count($arrCCN);

    /* Step 1 – Starting from the rightmost digit double the value of every second digit, */

    // get the numbers that will not be doubled
    $singleNumbers = [];
    for ($i=$arrCCNCount-1; $i >= 0 ; $i-=2) { 
        $singleNumbers[] = $arrCCN[$i];
    }

    // get the numbers that will be doubled
    $toDoubleNumbers = [];
    for ($y=$arrCCNCount-2; $y >= 0 ; $y-=2) { 
        $toDoubleNumbers[] = $arrCCN[$y];
    }

    // double the $toDoubleNumbers
    $doubledNumbers = [];
    foreach ($toDoubleNumbers as $numX) {
        $doubledNumbers[] = $numX * 2;
    }


    /* Step 2 – If doubling of a number results in a two digits number i.e greater than 9(e.g., 6 × 2 = 12), then add the digits of the product (e.g., 12: 1 + 2 = 3, 15: 1 + 5 = 6), to get a single digit number. */

    // get the single digit number of the doubled number
    $singleDigitNumbersOfDoubled = [];
    foreach ($doubledNumbers as $numY) {
        
        if($numY <= 9)
        {
            $singleDigitNumbersOfDoubled[] = $numY;
        }
        else
        {
            $splitDoubleDigits = array_map('intval', str_split($numY));
            $singleOfDoubleDigits = 0;
            foreach ($splitDoubleDigits as $numV) {
                $singleOfDoubleDigits += $numV;
            }

            $singleDigitNumbersOfDoubled[] = $singleOfDoubleDigits;
        }


    }


    /* Step 3 – Now take the sum of all the digits. */

    $singleNumbersSum = 0;
    foreach ($singleNumbers as $numK) {
        $singleNumbersSum += $numK;
    }

    $doubledNumbersSum = 0;
    foreach ($singleDigitNumbersOfDoubled as $numG) {
        $doubledNumbersSum += $numG;
    }

    /* Step 4 – If the total modulo 10 is equal to 0 (if the total ends in zero) then the number is valid according to the Luhn formula; else it is not valid. */

    $totalModulo = $singleNumbersSum + $doubledNumbersSum;
    $totalModuloArray = array_map('intval', str_split($totalModulo));
    $totalModuloEnding = end($totalModuloArray);


    
    $result = '';
    if($totalModuloEnding == 0)
    {
        $result = 'Valid';
    }
    else
    {
        $result = 'Invalid';
    }

    echo "<b>Credit Card Number:</b>  $ccn <br>";
    echo "<b>Result:</b> $result according to Luhn Algorithm.";
    

}

validateCreditCardNumber($creditCardNumber);

?>



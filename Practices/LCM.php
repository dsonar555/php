<?php

function isPrime($number) {
    if( ($number % 2) == 0 ) {
        return false;
    } else {
        for($i=3; $i<=($number/2); $i+=2) {
            if( ($number % $i) == 0 ) {
                return false;
            } 
        }
        return true;
    }
}

function findLCM($number1,$number2)
{
    $factorsOfNumber1 = [];
    $factorsOfNumber2 = [];
    $commonFactors = [];
    $lcm = 1;
    for($i=1 ; $i<=$number1; $i++) {
        if( ($number1 % $i) == 0 ) {
            if( isPrime($i))
                array_push( $factorsOfNumber1, $i );
        }
    }
    for($i=1 ; $i<=$number2; $i++) {
        if( ($number2 % $i) == 0 ) {
            if( isPrime($i))
                array_push( $factorsOfNumber2, $i );
        }
    }
    for($i=0; $i<count($factorsOfNumber1); $i++) {
        for($j=0; $j<count($factorsOfNumber2); $j++) {
            if($factorsOfNumber1[$i] === $factorsOfNumber2[$j]) {
                array_push( $commonFactors, $factorsOfNumber1[$i] );
            }
        }
    }
    foreach( $commonFactors as $factors) {
        $lcm *= $factors;
    }
    return $lcm;
}

findLCM(12,24);

?>
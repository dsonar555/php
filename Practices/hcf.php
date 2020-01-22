<?php

function calculateHCF($number1, $number2) {
    $factorsOfNumber1 = [];
    $factorsOfNumber2 = [];
    $hcf = 0;
    for($i=1 ; $i<=$number1; $i++) {
        if( ($number1 % $i) == 0 ) {
            array_push( $factorsOfNumber1, $i );
        }
    }
    for($i=1 ; $i<=$number2; $i++) {
        if( ($number2 % $i) == 0 ) {
            array_push( $factorsOfNumber2, $i );
        }
    }
    for($i=0; $i<count($factorsOfNumber1); $i++) {
        for($j=0; $j<count($factorsOfNumber2); $j++) {
            if($factorsOfNumber1[$i] === $factorsOfNumber2[$j]) {
                $hcf = $factorsOfNumber1[$i];
            }
        }
    }
    return $hcf;
}

$number_one = 84;
$number_two = 72;
echo "HCF of $number_one & $number_two is : ".calculateHCF($number_one, $number_two);

?>
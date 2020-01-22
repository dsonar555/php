<?php

function findFactors($number) {
    $factors = [];
    for($i=1; $i<=$number; $i++) {
        if( ($number % $i) == 0 ) {
            array_push($factors,$i);
        }
    }
    return $factors;
}

$number = 45 ;
echo "Factors of $number : ";
$factors = findFactors($number);
foreach($factors as $element) {
    echo "$element ";
}

?>
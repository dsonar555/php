<?php 
//1 +125 + 27 =153 

function isArmstrong($number) {
    $variableForChecking = $number; 
    $newNumber = 0;
    while($number > 0) {
        $mod = $number % 10;
        $mod = $mod * $mod *$mod; 
        $newNumber += $mod;
        $number /= 10;
    }
    if( $variableForChecking == $newNumber) {
       return true;
    }
    else {
        return false;
    }
}

$number = 345;

if( isArmstrong($number) ) {
    echo "The $number is an armstrong number.";
}
else {
    echo "The $number is not an armstrong number.";
}

?>
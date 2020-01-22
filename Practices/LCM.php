<?php


require_once 'hcf.php';

function findLCM($number1,$number2)
{
    $hcf = calculateHCF($number1, $number2);
    $lcm = ($number1 * $number2 )/$hcf;
    return $lcm;
}

$number_one = 84;
$number_two = 72;
echo "<br>LCM of $number_one & $number_two is : ".findLCM($number_one, $number_two);

?>
<?php

function swap(&$number1, &$number2)
{
    $temp = $number1;
    $number1 = $number2;
    $number2 = $temp;
}

$number_one = 3;
$number_two = 5;
echo "Before Swapping <br>";
echo "first number: $number_one <br>";
echo "second number: $number_two <br>";

swap($number_one, $number_two);
echo "After Swapping <br>";
echo "first number: $number_one <br>";
echo "second number: $number_two <br>";

?>
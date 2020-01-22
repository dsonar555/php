<?php 

function factorial($number)
{
    $factorialOfNumber=1;
    for($i=1; $i<=$number; $i++)
    {
        $factorialOfNumber *= $i;
    }
    return $factorialOfNumber;
}

$number = 4;
echo "Factorial of $number : ".factorial($number);

?>
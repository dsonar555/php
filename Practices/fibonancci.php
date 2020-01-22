<?php 

function fibonancci($length)
{
    $tempVariable1 = 0;
    $tempVariable2 = 1;
    $number=0;
    for($i=0; $i<=$length; $i++)
    {
        echo "$number ";
        $tempVariable1 = $tempVariable2;
        $tempVariable2 = $number;
        $number = $tempVariable1 + $tempVariable2;
    }
}

fibonancci(10);
?>
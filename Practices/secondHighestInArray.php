<?php

function secondHighest($array)
{
    $secondHighest;
    $biggest = $array[0];
    for($i=1; $i<count($array); $i++)
    {
        if($array[$i] > $biggest)
        {
            $secondHighest = $biggest;
            $biggest = $array[$i];
        } else if( ($secondHighest < $array[$i]) && ( $secondHighest < $biggest) )
        {
            $secondHighest = $array[$i];
        }
    }
    return $secondHighest;
}

$array = [4,305,700,1000,880,900];
echo "second large Number is : ".secondHighest($array);

?>
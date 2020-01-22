<?php

function biggestNumber($array) {
    $largeNumber=0;
    for($i=0; $i<count($array); $i++) {
        for($j=0; $j<count($array); $j++) {
            if($array[$j]>$array[$i])
            {
                $largeNumber = $array[$j];
            }
        }
    }
    return $largeNumber;
}
$array = [67,68,69,61,65];
echo "large Number is : ".biggestNumber($array);

?>
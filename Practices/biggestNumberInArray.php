<?php

function biggestNumber($array) {
    $largeNumber = $array[0];
    // for($i=0; $i<count($array); $i++) {
    //     for($j=0; $j<count($array); $j++) {
    //         if($array[$j]>$array[$i])
    //         {
    //             $largeNumber = $array[$j];
    //         }
    //     }
    // }
    for($i=1; $i<count($array); $i++) {
        if($largeNumber < $array[$i]) {
            $largeNumber = $array[$i];
        }        
    }
    return $largeNumber;
}
$array = [7,8,9,61,5];
echo "large Number is : ".biggestNumber($array);

?>
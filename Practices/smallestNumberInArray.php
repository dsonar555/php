<?php

function smallestNumber($array)
{  
    $smallerNumber = $array[0];
    for($i=1; $i<count($array); $i++) {
        if($smallerNumber > $array[$i]) {
            $smallerNumber = $array[$i];
        }        
    }
    return $smallerNumber;
}
$array = [4,35,0,1,8,90];
print_r($array);
echo '<br>Smallest number in array is : '.smallestNumber($array);

?>
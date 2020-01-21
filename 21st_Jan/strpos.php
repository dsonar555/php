<?php

$find = "t";
$findLength = strlen($find);
$offset=0;

$string = "this is an example string. This is used to do demo.";

// echo $strPosition = strpos($string, $find, $offset);
// while($strPosition = strpos($string, $find, $offset) )
// {
//     echo "<strong>'$find'</strong> found at : $strPosition <br>";
//     $offset = $strPosition + $findLength;
// }

$strPosition = strpos($string, $find, $offset);
do {
    echo "<strong>'$find'</strong> found at : $strPosition <br>";
    $offset = $strPosition + $findLength;
} while( $strPosition = strpos($string, $find, $offset) );

?>
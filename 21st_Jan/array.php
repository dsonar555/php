<?php

/* $food = array('Pizza','Pasta','Noodles');
echo $food[0].', &nbsp';
echo $food[1].', &nbsp';
echo $food[2].'&nbsp';
$food[3] = 'Salad';
echo'<br>';
print_r($food);

echo "<br>element at index 2 is : {$food[2]}";
echo "<br>element at index 2 is : $food[2]"; */


/* $array = array(1, 1, 1, 1,  1, 8 => 1,  4 => 1, 19, 3 => 13);
echo "<br>";
print_r($array);
 */

$max_int = 9223372036854775807;
$array = [];

$array[1] = "something";
print_r($array);
echo "<br>"; 
$array[ $max_int ] = "value at $max_int";
print_r($array);
echo "<br>"; 
$array[0] = "value at 0";
print_r($array);
echo "<br>"; 
$array[] = "New value at 1";
print_r($array);
echo "<br>"; 

echo PHP_INT_MAX ;

?>
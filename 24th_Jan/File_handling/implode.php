<?php

$array1 = ['Good','Afternoon'];
$array2 = ['How','are','you','doing?'];

$string[0] = implode(' ',$array1);
$string[1] = implode(' ',$array2);
echo '<br>String1 : '.$string[0];
echo '<br>String2 : '.$string[1];
echo '<br> ';
print_r($string);

$newString = implode('! ',$string);
echo '<br>'.$newString;

?>
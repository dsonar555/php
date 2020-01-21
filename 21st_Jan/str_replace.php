<?php

$string = "this is a string and is an example.";
// $newString = str_replace('is','was',$string);
// echo $newString;

$find = ['is','string','example'];
$replace = ['IS', 'STRING', 'EXAMPLE'];

$newString = str_replace($find, $replace, $string );
echo "OLD STRING : $string<br>";
echo "NEW STRING : $newString";

?>
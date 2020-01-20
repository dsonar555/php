<?php

$string = 'We live in India.';
$shuffled_string = str_shuffle($string);
echo $shuffled_string;
echo '<br>';

$str = 'abcdefgh12345678';
$half = substr(str_shuffle($str),0,5);
echo $half;
echo '<br>';

$half = substr(str_shuffle($str),0,strlen($str)/2);
echo $half;
echo '<br>';

$reverse = strrev($string);
echo $reverse;

?>
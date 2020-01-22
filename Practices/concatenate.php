<?php

$string1 = 'JOHN';
$string2 = 'SMITH';
$newString = '';
for($i=0; $i<strlen($string1); $i++)
{
    $newString .= $string1[$i].$string2[$i];
}
if(strlen($string1) < strlen($string2) )
{
    $newString .= substr($string2, strlen($string1), strlen($string2) );
}
echo $newString;

?>
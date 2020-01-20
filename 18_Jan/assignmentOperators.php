<?php

$num1=50;
$num2=10;

$num1+=5;	// same as $num1 = $num1 + 5;
echo $num1."<br>";
$num1-=5;	// same as $num1 = $num1 - 5;
echo $num1.'<br>';
$num1*=5;	// same as $num1 = $num1 * 5;
echo $num1.'<br>';
$num1/=5;	// same as $num1 = $num1 / 5;
echo $num1.'<br>';
$num1%=3;	// same as $num1 = $num1 % 3;
echo $num1.'<br><br>';

$num1=50;
$num2+=$num1;
echo $num2.'<br>';
$num2-=$num1;
echo $num2.'<br>';
$num2*=$num1;
echo $num2.'<br>';
$num2/=$num1;
echo $num2.'<br>';
$num2%=$num1;
echo $num2.'<br>';



$firstName = "Divya";
$lastName = "Sonar";

$firstName .= $lastName;
echo $firstName;
?>
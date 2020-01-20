<?php

$var1='divya';
$var2=100;
$var3=10.05;
$var4=true;
$var5=10894562334567894578798;
$var6=1000345.00450065;

// echo '<br> the type of variable var1 is '.gettype($var1).' and having value '.$var1;
// echo '<br> the type of variable var2 is '.gettype($var2).' and having value '.$var2;
// echo '<br> the type of variable var3 is '.gettype($var3).' and having value '.$var3;
// echo '<br> the type of variable var4 is '.gettype($var4).' and having value '.$var4;
// echo '<br> the type of variable var5 is '.gettype($var5).' and having value '.$var5;
// echo '<br> the type of variable var6 is '.gettype($var6).' and having value '.$var6;

$foo = 'Bob';              // Assign the value 'Bob' to $foo
$bar = &$foo;              // Reference $foo via $bar.
$bar = "My name is $bar <br>";  // Alter $bar...
echo $bar;
echo $foo; 

?>
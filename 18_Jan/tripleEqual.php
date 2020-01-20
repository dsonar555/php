<?php

$var1='1';
$var2=1;


echo "results using == <br>";
if($var1==$var2)
{
	echo 'both values are equal but types are different<br> ';
	echo "var1 is ";var_dump($var1);
	echo "<br>var2 is ";var_dump($var2);
}
else
	echo "<br>both values are different";

echo "<br><br>results using === <br>";
if($var1===$var2)
{
	echo '<br>both values are equal but types are also same<br> ';
	echo "var1 is ";var_dump($var1);
	echo "<br>var2 is ";var_dump($var2);
}
else
	echo "both values are different or types are different";



// $var3="divya";
// var_dump($var3);
?>
<?php

/* function printName()
{
	echo "Divya";
}

function printHello()
{
	echo 'Hello';
}

printHello();
echo' ';
printName();
echo '<br> You are learning functions in php';
*/

/* add();
// printName();
if(true)
{
	function printName()
	{
		echo "Divya";
	}
}
printName();
function add()
{
	echo "2"+"20"."<br>";
} */

function add()
{
	echo "2"+"20"."<br>";
	echo "it will exist in all over the program";
	function printName()
	{
		echo "<br>It doesn't exist auntil the add()is processed.";
	}
} 
// printName();
add();
printName();

?>
<?php

	$result= 45+5*2/2%3;//it is like--- 45+(((5*2)/2)%3) therefore ans is 47 
	echo $result.'<br>';

	$result= 45+5*2/(2%3);
	echo $result.'<br>';

	$result= 45+5*(2/2)%3;
	echo $result.'<br>';

	$result= (45+5)*2/2%3;
	echo $result.'<br>';

?>
<?php

	$string = '     This is an example string. ';
	var_dump( $string );
	$string_trimmed = trim($string);
	echo '<br>';
	var_dump( $string_trimmed );

	$string = "     This is a string.     ";
	echo '<br>';
	var_dump( $string );
	$string_trimmed = ltrim($string);
	echo '<br>';
	var_dump( $string_trimmed );
	$string = "     This is a string.    ";
	echo '<br>';
	var_dump( $string );
	$string_trimmed = rtrim($string);
	echo '<br>';
	var_dump( $string_trimmed );

	$string = 'she said,"Its great."';
	$new = addslashes($string);
	echo '<br>'.$new;
	$new = stripslashes($string);
	echo '<br>'.$new;

	$string='<img src="image.jsp"> tag is used to display image.';
	echo '<br>'.$string;
	echo '<br>'.htmlentities($string);

?>
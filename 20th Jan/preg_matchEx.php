<?php

// $string='This is a example of string';
// $find='/is/';

// if(preg_match($find,$string,$matches)) {
// 	echo 'Match found';
// 	print_r($matches);
// }
// else
// 	echo 'Not found';

// echo preg_match("/^[A-Z]*/","This ia an example.");

// function has_space($string)
// {
// 	if(preg_match('/ /',$string))
// 		return true;
// 	else
// 		return false;
// }

// $string='Thisisaexampleofstring';
// if (has_space($string)) {
// 	echo 'has at least one space.';
// }
// else
// {
// 	echo 'has no spaces';
// }


/* $string='This is a example of string';
$find='/(ex)(am)(ple)/';

if(preg_match($find,$string,$matches,PREG_OFFSET_CAPTURE,3)) {
	echo 'Match found';
	print_r($matches);
}
else
	echo 'Not found';
 */

echo( preg_match("/[\x{0600}-\x{06FF}\x]{1,32}/u", 'محمد') );

// ?>
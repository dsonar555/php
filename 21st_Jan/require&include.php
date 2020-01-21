<?php

/* require 'header.php';//if file doesn't exit it will not execute rest of the code. 
//include 'header.php';//if file doesn't exit it will show an error and execute rest of the code. 
echo $var1;
echo 'Good Morning';
//include 'header.php';
//include_once 'header.php';
require_once 'header.php';
 */

/* echo "A $color $fruit";
include "header.php";
echo '<br> A'.$color.' '.$fruit;
 */

// function trial() {
//     global $color;
//     include "header.php";
//     echo "A $color $fruit";
// }
// trial();
// echo "A $color $fruit";

/* if( include('header.php') == TRUE ) {
    echo "ok";
} else {
    echo "not Ok.";
}

if( (include 'header.php') == TRUE ) {
    echo "ok";
} else {
    echo "not ok";
} */

$val = include('header.php');
echo $val;

?>
<?php

/* // include_once 'header.php';
require_once 'header.php';
echo $color;
$color="red";
echo "<br>".$color;
include_once 'header.php';
echo "<br>".$color; */

// require_once 'header.php';
// echo $var1;

function trial()
{
    require_once 'header.php';
    //global $var1;
    return $var1;
}

for($i=0; $i<5; $i++)
{
    echo trial()."<br>";
}

?>
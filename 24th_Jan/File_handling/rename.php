<?php

$fileName = "demoDirectory/file2.txt";
$newName = 'demoDirectory/'.rand().'.txt';
if(rename($fileName, $newName))
{
    echo "$fileName is renamed to $newName."; 
} else {
    echo 'Error in Renaming.';
}

?>
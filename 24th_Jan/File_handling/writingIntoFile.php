<?php

$fileHandle = fopen("demoFile.txt","w");
fwrite($fileHandle, "Good Morning \n I am learning file handling today.");
fclose($fileHandle);

?>
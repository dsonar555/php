<?php

// $fileHandle = fopen("demoFile.txt","r");
// $data = fread($fileHandle, 50);
// fclose($fileHandle);
// echo $data;
$allData = file("demoFile.txt");
print_r($allData);
echo '<br>';
foreach( $allData as $lines) {
    echo $lines.'<br>';
}

?>
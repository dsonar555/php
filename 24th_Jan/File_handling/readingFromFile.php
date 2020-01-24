<?php
$fileName = 'demoFile.txt';
$fileHandle = fopen($fileName,"r");
$data = fread($fileHandle, filesize($fileName));
fclose($fileHandle);
// echo $data;
$sentences = explode('.',$data);
print_r($sentences);

// $allData = file("demoFile.txt");
// print_r($allData);
// echo '<br>';
// foreach( $allData as $lines) {
//     echo $lines.'<br>';
// }

?>
<?php

// $fileNameOr = 'file1.txt';
// $fileName = rand(10000,99999).md5($fileNameOr).rand(10000,99999);

// echo $fileName;

$fileName = 'demoDirectory/file4.txt';
if(file_exists($fileName)) {
    echo 'File already exists.';
} else {
    $handle = fopen($fileName, 'w');
    fwrite($handle, 'Created '.$fileName.' just now');
    fclose($handle);
    echo $fileName.' is created.';
}

?>
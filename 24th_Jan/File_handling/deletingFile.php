<?php

$fileName = 'demoDirectory/file4.txt';

if( @unlink($fileName) ) {
    echo "The $fileName is deleted.";
} else {
    echo "The file is not deleted.";
}

?>
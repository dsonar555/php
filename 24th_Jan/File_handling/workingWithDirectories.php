<?php

$directory = 'demoDirectory';
if( $dirHandle = opendir($directory.'/') ) {
    echo 'Looking inside \''.$directory.'\'<br>';
    while( $file = readdir($dirHandle) ) {
        if( ($file != '.') && ($file != '..') )
        echo '<a href="'.$directory.'/'.$file.'">'.$file.'</a><br>';
    }
}

?>
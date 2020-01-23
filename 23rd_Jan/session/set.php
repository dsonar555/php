<?php

session_start();
$_SESSION['username'] = "Divya";
$_SESSION['birthdate'] = "10-feb";
if( isset($_SESSION['username']) && isset($_SESSION['birthdate']) )
{
    echo "session is set";
}

?>
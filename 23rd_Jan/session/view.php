<?php

session_start();
if(isset($_SESSION['username']) || isset($_SESSION['birthdate'])) {
    echo "welcome, {$_SESSION['username']}. You'r birthday is on {$_SESSION['birthdate']}";
} else {
    echo "Please log in first...";
}

?>
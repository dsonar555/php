<?php
    session_start();
    if(empty($_SESSION['user_id']))
    {
        header('location: login.php');
    }
    else
    {
        session_destroy();
        header('location: login.php');
    }
    
?>
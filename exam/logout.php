<?php
    session_start();
    require_once 'databaseConnection.php';
    if(empty($_SESSION['user_id']))
    {
        header('location: login.php');
    }
    else
    {
        $data['last_login_at'] = '\''.date('Y-m-d H:i:s').'\'';
        $id = update('user',$data,'user_id',$_SESSION['user_id']);
        if($id)
        {
            session_destroy();
            header('location: login.php');
        }
    }
    
?>
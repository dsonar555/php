<?php 
ob_start();
?>
<h1>Hello</h1>
This is a demo page.
<?php

$redirect = false;
$link = "http://google.com";
if($redirect)
    header('Location: '.$link);

ob_end_flush();
?>
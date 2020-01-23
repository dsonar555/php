<?php

require_once 'conf.php';

// foreach($blocked_ip as $ip) {
//     if($ip == $ip_address)
//     {
//         die('your ip '.$ip.' has been blocked.');
//     }
// }

$client_ip = $_SERVER['HTTP_CLIENT_IP'];
$http_x_forwarded_for = $_SERVER['HTTP_X_FORWARDED_FOR'];
$remote_addr = $_SERVER['REMOTE_ADDR'];
 if(!empty($client_ip)) {
    $ip = $client_ip;
 } else if(!empty($http_x_forwarded_for)) {
    $ip = $http_x_forwarded_for;
 } else if(!empty($remote_addr)) {
     $ip = $http_x_forwarded_for;
 }
echo $ip;

?>
<h1>
Welcome
</h1>
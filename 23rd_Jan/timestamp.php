<?php
/* // echo date_default_timezone_get();
date_default_timezone_set("Asia/Kolkata");
$time = time();
$currentTime = date( 'd-m-Y @ H:i:s ', $time);
$modifieTime = date( 'd-m-Y @ H:i:s', strtotime('- 1 month'));
echo "<br>The current date and time is ".$currentTime; 
echo '<br>The modified date and time is '.$modifieTime;

$modifieTime = date( 'd-m-Y @ H:i:s', strtotime('+ 1 month 3 hours 30 minutes'));
echo '<br>The modified date and time is '.$modifieTime;
 */
echo "LEAP year";
$dateTime = new DateTime("2020-01-31",new DateTimeZone("Asia/Kolkata"));
echo '<br>'.$dateTime->format('d-M-Y @ H:i:s'), PHP_EOL;
// $dateTime->modify("+ 1 month");
// echo '<br>'.$dateTime->format('d-M-Y @ H:i:s');
$dateTime->modify("last day of next month");
echo '<br>'.$dateTime->format('d-M-Y @ H:i:s');


echo '<br>Normal year';
$dateTime = new DateTime("2015-01-31",new DateTimeZone("Asia/Kolkata"));
echo '<br>'.$dateTime->format('d-M-Y @ H:i:s'), PHP_EOL;
// $dateTime->modify("+ 1 month");
// echo '<br>'.$dateTime->format('d-M-Y @ H:i:s');
$dateTime->modify("last day of next month");
echo '<br>'.$dateTime->format('d-M-Y @ H:i:s');


?>
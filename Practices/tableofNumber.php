<?php

function table($number) {
    for($i=1; $i<=10; $i++) {
        echo "$number X $i = ".$number*$i."<br>";
    }
}

$number = 5;
table( $number );

?>
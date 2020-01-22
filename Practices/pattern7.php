<?php

for($i=1; $i<=5; $i++) {
    $string ="";
    for($j=1; $j<=$i; $j++) {
        $string .= "*";
        echo $string;
    }
    for($j=1; $j<=$i; $j++) {
        echo "0";
    }
    echo "<br>";
}

?>
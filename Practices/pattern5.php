<?php
$counter=1;
$row=4;
for($i=0; $i<$row; $i++) {
    $new = $counter;
    for($j=0; $j<3; $j++)
    {
        
        echo ' '.$new;
        $new += $row;
    }
    $counter++;
    echo "<br>";
}

?>
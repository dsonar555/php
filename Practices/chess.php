<?php

echo '<table border="1" style=" border:solid">';
$color = "white";
for($i=0; $i<8; $i++) {
    echo "<tr>";
    for($j=0; $j<8; $j++) {
        if($color === "white") {
            echo '<td style="background-color: white;">&nbsp&nbsp&nbsp</td>';
            if( $j!=7)
                $color="black";
        } else {
            echo '<td style="background-color: black;">&nbsp&nbsp&nbsp</td>';
            if( $j!=7)
                $color="white";
        }
    }
    echo "</tr>";
}
echo "</table>";
?>